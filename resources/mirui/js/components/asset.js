
imageControl = function(args01, mode, args02, passingdata){
    if(user && user['accrisk'] === true && args01 !== undefined && mode != null && args02 != null){
        if(args01 && args01.includes('risk-') && args02 && mode){
            var fetchData = new URLSearchParams();
            fetchData.append('risk', mode);
            fetchData.append("raw", JSON.stringify(args02));

            fetch(root + "core/asset/", {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                }, 
                body: fetchData
            })
            .then(Response => Response.json())
            .then(function(var01){
                if(var01.status == 'ok' && var01.visual){
                    imageStore2 = var01.visual;
                    // console.log(var01.visual);
                    if(args01 == 'risk-articleInsert'){
                        articleInsertControl(undefined, true);
                    }else if(args01 == 'risk-articleEdit'){
                        articleEditControl(passingdata, undefined, true);
                    }
                }else{
                    imageStore = null;
                    imageStore2 = null;
                    if(args01 == 'risk-articleInsert'){
                        articleInsertControl(undefined, false);
                    }else if(args01 == 'risk-articleEdit'){
                        articleEditControl(passingdata, undefined, false);
                    }                
                }
            })
            .catch(function(var01){
                // append no image icon
                console.log(var01);
                imageStore = null;
                imageStore2 = null;
                if(args01 == 'risk-articleInsert'){
                    articleInsertControl(undefined, false);
                }else if(args01 == 'risk-articleEdit'){
                    articleEditControl(passingdata, undefined, false);
                }
            });
        }
    }else if(args01){
        args01 = args01.toLowerCase();
        var fetchData = new URLSearchParams();
        fetchData.append("asset", 0);
        fetchData.append("assetid", args01);

        fetch(root + "core/asset/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        .then(Response => Response.json())
        .then(function(var01){
            if(var01.status == 'ok' && var01.raw){
                if(var01.raw != null){
                    var imgData = var01.raw; //btoa()
                    // console.log(var01.raw);
                    var imgURL = 'data:image/jpeg;base64, ' + imgData;
                    fetch(imgURL)
                    .then(Response => Response.blob())
                    .then(function(Response){
                        imgURL = URL.createObjectURL(Response);
                        var element = document.getElementsByClassName('core-imageControl-' + args01);
                        // console.log(args01);
                        // document.documentElement.style.setProperty('--core-imageControl-' + args01, "url('" + imgURL + "')");
                        for(var i = 0; i < element.length; i++){
                            element[i].style.setProperty('--core-imageControl-' + args01, "url('" + imgURL + "')");
                            if(element[i].tagName == 'IMG'){
                                element[i].setAttribute('src', imgURL);
                            }
                        }
                    });
                }else{
                    //append no image icon
                }
            }else{
                // append no image icon
            }
        })
        .catch(function(var01){
            // append no image icon
            console.log(var01);
        });
    }
}