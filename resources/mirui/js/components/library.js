
var userLibrary = {"library": []};

libraryServer = function(){
    var fetchData = new URLSearchParams();

    fetch(root + "core/library/", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        }, 
    })
    .then(var01 => var01.json())
    .then(function(var01){
        if(var01.library){
            userLibrary['library'] = var01.library;
            if(contentPage && contentSel == 'library'){
                articleControl(false, 'library');
            }
        }
        if(!contentSel){
            earlyInit(); //onload(2)
        }
    })
    .catch(function(var01){
        // dno nothing
        console.log(var01);
    });
}
