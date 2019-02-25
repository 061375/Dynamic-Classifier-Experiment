/**
 *
 * @param {Object}
 * @param {Array}
 * */
function drawImage($t,s, callback) {
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
    
    if (typeof callback === 'function')
        callback($t);
}
/**
 * @param {Object}
 * */
function drawClass($t, callback) {
    let _class = document.createElement('section');
    $t.append(_class);
    if (typeof callback === 'function')
        callback(_class);
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
            let r = Math.floor(Math.random() * 2000);
            if (r > (1550 + Math.random() * 500)) {
                r = 1;
            }else{
                r = 0;
            }
            sample[y][x] = r;
        }
    }
    return sample;
}