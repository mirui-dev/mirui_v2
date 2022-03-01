
var user = [];
var userAvatar = null;

userServer = function(query){
    var fetchData = new URLSearchParams();
    fetchData.append('query', query);

    fetch(root + "auth/", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        }, 
        body: fetchData
    })
    .then(Response => Response.json())
    .then(function(var01){
        if(var01.status == 'ok'){
            if(query === true && var01.user){
                user = var01.user;
                earlyInit(); //onload
                if(contentPage == 'profile'){
                    userControl(true, query);
                }
            }else if(query == 'avatar'){
                if(var01.avatar != null){
                    var imgData = var01.avatar; //btoa()
                    var imgURL = 'data:image/jpeg;base64, ' + imgData;
                    // console.log(imgURL);
                    fetch(imgURL)
                    .then(Response => Response.blob())
                    .then(function(Response){
                        imgURL = URL.createObjectURL(Response);
                        userAvatar = imgURL;
                        if(contentPage == 'profile'){
                            userControl(true, query);
                        }
                    });
                }else{
                    userAvatar = null;
                    if(contentPage == 'profile'){
                        userControl(true, query);
                    }
                }
            }
        }else{
            // append no image icon
            if(contentPage == 'profile'){
                userControl(false, false);
            }
        }
    })
    .catch(function(var01){
        // console.log(var01);
    });
}

userAvatarServer = function(img64){
    var fetchData = new URLSearchParams();
    fetchData.append('raw', img64);
    fetchData.append('query', null); //magickk
    // console.log(img64);

    fetch(root + "auth/", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        }, 
        body: fetchData
    })
    .then(Response => Response.json())
    .then(function(var01){
        if(var01.status == 'ok'){
            //callback
            userAvatarControl(true);
        }else{
            // callback
            userAvatarControl(false);
        }
    })
    .catch(function(var01){
        // console.log(var01);
    });
}
