window.onload = () => {
    'use strict';
    
    var swidth = 12;
    
    var sample = makeImage(swidth);
    
    console.log(sample);
    
    drawClass($('#target'),function($t){
        drawImage($t,sample);
    });
    // setFirst
    // setTrain
    Ajax.get('setTrain',{
        sample:sample
    },function(data){
        drawClass($('#target'),function($t){
            $.each(data,function(k,v) {
                drawImage($t,v.img);         
            });
        });
    });
}