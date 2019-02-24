/**
 *
 * @param {Object}
 * @param {Array}
 * */
function drawImage($t,s) {
    //
    let image = document.createElement('div');
        $(image).attr('class','image');
    for(let y=0;y<s.length;y++) {
            let row = document.createElement('div');
                $(row).attr('class','row');
        for(let x=0;x<s[y].length;x++) {
            let div = document.createElement('div');
                if (s[y][x] == 1) {
                    $(div).attr('class','on');
                }else{
                    $(div).attr('class','off');
                }
            $(row).append(div);
        }
        $(image).append(row);
    }
    $t.append(image);
}
/**
 *
 * @param {Number}
 * @returns {Array}
 * */
function makeImage(swidth) {
    // @var {Array}
    var sample = [];
    for(let y=0;y<swidth;y++) {
        if (undefined === sample[y])
            sample[y] = [];
        for(let x=0;x<swidth;x++) {
            sample[y][x] = Math.floor(Math.random() * 2);
        }
    }
    return sample;
}