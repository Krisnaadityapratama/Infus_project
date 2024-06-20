<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Value;
use App\Models\Pasien;

class View extends Controller
{
    public function sensor($idAlat, $dropsPerMinutes, $kapasitas, $status)
    {
        if ($kapasitas < 0) {
            $kapasitas = 0;
        }
        $pasien = Pasien::where('alat', $idAlat)->where('status', '1')->first();
        $prediksi = ($kapasitas / $dropsPerMinutes) / 4;
        $dropsPerMinutes = $dropsPerMinutes - 1;

        Value::create([
            'idPasien' => $pasien->id,
            'tpm' => $dropsPerMinutes,
            'kapasitas' => $kapasitas,
            'prediksi' => $prediksi,
            'status' => $status
        ]);
    }

    public function index()
    {
        $tempData = Pasien::with('sensor.Value')->get();
        $tempValue = Value::get();

        $data = $tempData->toArray();
        $value = $tempValue->toArray();

        return view('index', ['data' => count($tempData) ? $data : 0]);
    }

    public function get()
    {
        $tempData = Pasien::with('sensor.Value')->get();
        $tempValue = Value::get();

        $data = $tempData->toArray();
        $value = $tempValue->toArray();

        return count($tempData) ? response()->json(['value' => $value, 'data' => $data], 200) : dd("dsadsa");
    }
}
