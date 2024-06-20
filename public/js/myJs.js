
$(document).ready(function() {
    var audio = new Audio('/media/sound.mp3');
    setInterval(function() {
        $.ajax({
            type: "get",
            url:"/get",
            success: function(result){
            
                var arrVal = result['value'];
                var arrData = result['data'];
                var x = 0;
                var tpm = document.getElementsByClassName('tpm');
                var status = document.getElementsByClassName('status');
                var kapasitas = document.getElementsByClassName('kapasitas');
                var prediksi = document.getElementsByClassName('prediksi');
                

                for(var i = 0; i<arrData.length; i++){
                    
                  if(arrData[i]['status']==1){
                    
                    for(var p = arrVal.length-1; p>=0; p--){
                        if(arrVal[p]['idPasien'] == arrData[i]['id']){
                            
                            tpm[x].innerHTML = arrVal[p]['tpm'];
                            status[x].innerHTML = arrVal[p]['status'];
                            kapasitas[x].innerHTML = arrVal[p]['kapasitas'];
                            predict = arrVal[p]['prediksi'];
                            if(predict < 0){
                                predict = 0;
                            }
                            prediksi[x].innerHTML = predict;
                            x++;
                           if(arrVal[p]['status'] == 'LOW'){
                            audio.play();
                           }
                           
                            break;
                        }
                        
                    }

                  }


                 
                }

            }
        })
    }, 5000);
   });