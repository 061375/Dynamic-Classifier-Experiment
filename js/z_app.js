window.onload = () => {
    'use strict';
    
    var swidth = 12;
    
    var sample = makeImage(swidth);
    
    console.log(sample);
    
    drawImage($('#target'),sample);
}