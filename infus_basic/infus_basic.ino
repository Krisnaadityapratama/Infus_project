#include <ESP8266WiFi.h>
#include <Ticker.h>
#include "HX711.h"
#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Servo.h>

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64
#define OLED_RESET -1
#define SCREEN_ADDRESS 0x3C

Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

#define DOUT_PIN D6
#define CLK_PIN D7

Ticker blinker;
Servo myservo;

float tPerDrops;
float timeMillis;
unsigned long jumlahTetes = 0;
float oldtPerDrops;
float dropsPerMinutes;
float dropsPerSecond;
float kapasitas = 0;
String idAlat = "11111111";
String status = "";
int dropRate = 0;

HX711 scale(DOUT_PIN, CLK_PIN);
float calibration_factor = -238635;

void ICACHE_RAM_ATTR voidCounter();

const char* ssid = "Server"; //Hostname Wifi
const char* password = "Serverku"; //Password Hostname
const char* host = "192.168.211.118"; //Ip Host Laptop (wifi ip)

void timerIsr() {
  blinker.detach();
  tPerDrops = timeMillis - oldtPerDrops;
  oldtPerDrops = timeMillis;
  if (tPerDrops > 100) {
    dropsPerMinutes = 1000 / tPerDrops * 60;
    dropsPerSecond = 60 / dropsPerMinutes;
  }
  blinker.attach(0.1, timerIsr);
}

void voidCounter() {
  timeMillis = millis();
}

void setupProses() {
  attachInterrupt(digitalPinToInterrupt(14), voidCounter, FALLING);
  blinker.attach(0.1, timerIsr);
}

void setup() {
  Serial.begin(115200);
  myservo.attach(D4);
  scale.set_scale();
  scale.tare();
  long zero_factor = scale.read_average();

  Serial.println();
  pinMode(D3, INPUT_PULLUP);
  Serial.printf("Connecting to %s ", ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println(" connected");
  setupProses();
  if (!display.begin(SSD1306_SWITCHCAPVCC, SCREEN_ADDRESS)) {
    Serial.println(F("SSD1306 allocation failed"));
    for (;;);
  }
  myservo.write(0);
  getDropRateFromServer();
}

void loop() {
  int reset = digitalRead(D3);
  if (reset == 0) {
    resetV();
  } else {
    berat();
    timer();
    Kirim();
    getDropRateFromServer();
    controlServo(dropRate);
  }
}

void resetV() {
  dropsPerSecond = 0;
  dropsPerMinutes = 0;
}

unsigned long oldTimer;
void timer() {
  unsigned long tTimer = millis();
  if (tTimer - oldTimer > 2000) {
    oldTimer = tTimer;
    display.clearDisplay();
    display.setTextSize(2);
    display.setTextColor(WHITE);
    display.setCursor(0, 10);
    display.print("T/D :");
    display.println(dropsPerSecond);
    display.print("D/M :");
    display.println(dropsPerMinutes, 1);
    display.print("K :");
    display.println(kapasitas, 1);
    display.display();
  }
}

void berat() {
  scale.set_scale(calibration_factor);
  kapasitas = scale.get_units();
  kapasitas = kapasitas * 1000;
  if (kapasitas <= 0) {
    kapasitas = 0;
  }
  if (kapasitas <= 100) {
    status = "OFF";
  } else {
    status = "ON";
  }
}

unsigned long LTimer;
void Kirim() {
  WiFiClient client;
  unsigned long NTimer = millis();
  if (NTimer - LTimer > 60000) {
    LTimer = NTimer;
    Serial.printf("\n[Connecting to %s ... ", host);
    if (dropsPerSecond > 0) {
      if (client.connect(host, 80)) {
        Serial.println("connected]");
        String url = "/iot/public/sensor/" + idAlat + "/" + String(dropsPerMinutes) + "/" + String(kapasitas) + "/" + status;
        Serial.println("[Sending a request]");
        client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                     "Host: " + host + "\r\n" +
                     "Connection: close\r\n\r\n");
        Serial.println(client.status());
        Serial.println("[Response:]");
        while (client.connected() || client.available()) {
          if (client.available()) {
            String line = client.readStringUntil('\n');
            Serial.println(line);
          }
        }
        client.stop();
        Serial.println("\n[Disconnected]");
      } else {
        Serial.println("connection failed!]");
        client.stop();
      }
    }
  }
}

void getDropRateFromServer() {
  WiFiClient client;
  String url = "/iot/public/get-drop-rate/" + idAlat;

  if (client.connect(host, 80)) {
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");

    // Wait for the server to respond
    while (client.connected() && !client.available()) {
      delay(1);
    }

    // Read the response line by line
    String line;
    while (client.available()) {
      line = client.readStringUntil('\n');
      if (line.startsWith("{\"drop_rate\":")) {
        String dropRateStr = line.substring(13, line.indexOf('}'));
        dropRate = dropRateStr.toInt();
        Serial.print("Drop Rate from server: ");
        Serial.println(dropRate);
        break;  // Exit loop after finding the drop rate
      }
    }
  }
  client.stop();
}


void controlServo(int dropRate) {
  int angle = map(dropRate, 0, 100, 0, 180);
  myservo.write(angle);
  delay(1000);
}
