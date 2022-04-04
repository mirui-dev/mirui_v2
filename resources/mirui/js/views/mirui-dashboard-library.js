
libraryControl = function(articleid){
    var ret = false;
    var tmpArray = [];
    if(userLibrary['library'].length){
        ret = [];
        userLibrary['library'].forEach(function(count){
            tmpArray.push(count);
        })
        ret = tmpArray;
    }
    if(articleid){
        articleid = articleid.toUpperCase();
        for(var i = 0; i < tmpArray.length; i++){
            if(tmpArray[i]['articleid'].toUpperCase() == articleid){
                ret = true;
                i = tmpArray.length;
            }
        }
        if(ret != true){
            ret = false;
        }
    }
    return ret;
}
