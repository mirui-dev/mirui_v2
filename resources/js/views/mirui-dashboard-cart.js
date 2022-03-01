
cartControl = function(articleid, isDel){
    if(articleid && articleid.toLowerCase() == 'maintenance'){
        // console.log('test');
        for(var i = 0; i < userCart['item'].length; i++){
            var isexist = 0;
            globalArticle.filter(function(article){
                if(article.articleid.toUpperCase() == userCart['item'][i].toUpperCase()){
                    if(parseInt(article.visible)){
                        isexist++;
                    }
                }
            });
            if(!isexist){
                // this movie no longer exists
                cartControl(userCart['item'][i], true);
            }
        }
    }else if(articleid){
        articleid = articleid.toUpperCase();
        if(isDel){
            if(userCart['item'].includes(articleid)){
                userCart['item'].splice(userCart['item'].indexOf(articleid), 1);
                cartServer(JSON.stringify(userCart));

            }
        }else{
            // if(articleid.toLowerCase() == 'maintenance'){
            //     // console.log('test');
            //     for(var i = 0; i < userCart['item'].length; i++){
            //         var isexist = 0;
            //         globalArticle.filter(function(article){
            //             if(article.articleid.toUpperCase() == userCart['item'][i].toUpperCase()){
            //                 if(parseInt(article.visible)){
            //                     isexist++;
            //                 }
            //             }
            //         });
            //         if(!isexist){
            //             // this movie no longer exists
            //             cartControl(userCart['item'][i], true);
            //         }
            //     }
            // }else{
                if(userCart['item'].includes(articleid)){
                    // delete from cart
                    // injectNoti('Item has already been added to cart!', 'orange');
                    cartControl(articleid, true);
                }else{
                    // update article list
                    articleServer();
                    // perform a search whether articleid is valid
                    for(var i = 0; i < globalArticle.length; i++){
                        if(globalArticle[i]['articleid'] == articleid && !libraryControl(articleid)){
                            // add to cart
                            userCart['item'].push(articleid);
                            cartServer(JSON.stringify(userCart));
                            i = globalArticle.length;
                        }
                    }
                    
                }
            // }
        }
        if(contentPage && contentSel == 'cart'){
            // only update article when contentpage is active and is cart page
            articleControl(false, contentPage);
        }
        if(contentPage && document.getElementById('dashboard-content-sub-nav').classList.contains('active')){
            // control nav cart button when contentpage is active
            cartButtonControl(articleid);
        }
    }else if(articleid == 0){
        // empty cart
        userCart['item'] = [];
        cartServer(JSON.stringify(userCart));
    }else{
        return userCart['item'];
    }
}

cartCounter = function(){
    var element = document.getElementsByClassName('dashboard--cart-number');
    var count = userCart['item'].length;
    for(var i = 0; i < element.length; i++){
        element[i].innerHTML = count;
    }
    if(!count){
        document.getElementById('dashboard-nav-menu-cart-number').classList.remove('active');
        if(contentPage && contentSel == 'cart'){
            document.getElementById('browse-action-checkout').classList.add('disabled');
        }
    }else{
        document.getElementById('dashboard-nav-menu-cart-number').classList.add('active');
        if(contentPage && contentSel == 'cart'){
            document.getElementById('browse-action-checkout').classList.remove('disabled');
        }
    }
    return count;
}

cartButtonControl = function(status){
    var mainElement = document.getElementById('dashboard-content-sub-nav-childnode-cart');

    if(status == undefined){
        if(mainElement.getElementsByTagName('span')[0].classList.contains('lnr-checkmark-circle')){
            status = false; //to remove
        }else{
            status = true; // to add
        }
    }
    if(status && status != true){
        status = status.toUpperCase();
        for(var i = 0; i < cartControl().length; i++){
            if(cartControl()[i].toUpperCase() == status){
                status = true;
                i = cartControl().length;
            }
        }
        for(var i = 0; i < libraryControl().length; i++){
            if(status != 'true' && libraryControl()[i]['articleid'].toUpperCase() == status){
                status = 'library';
                i = libraryControl().length;
            }
        }

        // console.log(status);

        if(status !== true && status != 'library'){
            status = false;
        }
    }

    // console.log(status);

    mainElement.getElementsByTagName('span')[0].classList.remove('lnr-cart');
    mainElement.getElementsByTagName('span')[0].classList.remove('lnr-checkmark-circle');
    mainElement.getElementsByTagName('span')[0].classList.remove('lnr-cloud-check');
    document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.add('hidden');

    if(status == 'library'){
        mainElement.getElementsByTagName('span')[0].classList.add('lnr-cloud-check');
        mainElement.getElementsByTagName('span')[1].innerHTML = 'ADDED';
        mainElement.removeAttribute('onclick');
        document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.remove('hidden');

    }else if(status){
        // added to cart
        mainElement.getElementsByTagName('span')[0].classList.add('lnr-checkmark-circle');
        mainElement.getElementsByTagName('span')[1].innerHTML = 'UNADD';
    }else if(!status){
        // removed from cart
        mainElement.getElementsByTagName('span')[0].classList.add('lnr-cart');
        mainElement.getElementsByTagName('span')[1].innerHTML = 'ADD';
    }
}
