/*
window.onload = () => {
    'use strict';
    
    var swidth = 12;
    
    var sample = makeImage(swidth);
    
    console.log(sample);
    
    drawClass($('#target'),function($t){
        drawImage($t,sample);
    });
    // setFirst
    //setTrain
    Ajax.get('setTrain',{
        sample:sample
    },function(data){
        drawClass($('#target'),function($t){
            $.each(data,function(k,v) {
                drawImage($t,v.img,v.count);         
            });
        });
    });

    STYLES['.image']['min-width'] = swidth+'px';
    STYLES['.image']['min-height'] = swidth+'px';
    STYLES['.image .row div'].width = $('#psize').val()+'px';
    STYLES['.image .row div'].height = $('#psize').val()+'px';
    Helpers.setStyle();

    $('#psize').on('change',function(){
        STYLES['.image .row div'].width = $('#psize').val()+'px';
        STYLES['.image .row div'].height = $('#psize').val()+'px';
        Helpers.setStyle();
    });
}*/
function runIt(_function) {

    var swidth = 12;
    
    //sample = makeImage(swidth);
    sample = LETTER;

    console.log(sample);
    
    drawClass($('#target'),function($t){
        drawImage($t,sample);
    });

    STYLES['.image']['min-width'] = swidth+'px';
    STYLES['.image']['min-height'] = swidth+'px';
    STYLES['.image .row div'].width = $('#psize').val()+'px';
    STYLES['.image .row div'].height = $('#psize').val()+'px';
    Helpers.setStyle();

    $('#psize').on('change',function(){
        STYLES['.image .row div'].width = $('#psize').val()+'px';
        STYLES['.image .row div'].height = $('#psize').val()+'px';
        Helpers.setStyle();
    });
    if(typeof _function === 'function')
        _function();
}
function setFirst() {
    Ajax.get('setFirst',{
        sample:sample
    },function(data){
    });
}
function setTrain() {
    Ajax.get('setTrain',{
        sample:sample
    },function(data){
        drawClass($('#target'),function($t){
            $.each(data,function(k,v) {
                drawImage($t,v.img,v.count);         
            });
        });
    });
}