
var contentSel = 0;
var contentSubAllowsEscape = true;
var contentPage = null;

greetInject = function(){
    var var01 = new Date().getHours();
    if(user['accrisk']){
        var args01 = "ADMINISTRATOR";
        document.getElementById('dashboard-nav-greet-message').style.setProperty('color', 'darkred');
    }else if(var01 < 13){
        var args01 = "GOOD MORNING";
    }else if(var01 < 17){
        var args01 = "GOOD AFTERNOON";
    }else{
        var args01 = "GOOD EVENING";
    }
    document.getElementById('dashboard-nav-greet-message').innerHTML = args01;
    // if(!contentSel){
    //     earlyInit(); //onload(0)
    // }
}

contentControl = function(menuSel, articleid){
    if(menuSel && articleid){
        // sub section page
        var contentMain = document.getElementById('dashboard-content');
        var contentMain2 = document.getElementById('dashboard-nav-container');
        var contentSubNav = document.getElementById('dashboard-content-sub-nav');
        var contentSub = document.getElementById('dashboard-content-sub');
        if(contentSub.classList.contains('active') && contentSubAllowsEscape){
            for(var i = 0; i < contentMain.children.length; i++){
                contentMain.children[i].classList.remove('disabled');
            }
            // contentMain.style.removeProperty('cursor');
            contentMain.style.removeProperty('filter');
            contentMain2.style.removeProperty('filter');
            contentSub.classList.remove('active');
            contentSub.classList.remove('escapePrompt');
            contentSubNav.classList.remove('active');
            contentSubNav.classList.remove('escapePrompt');
            // contentSubNav.removeAttribute('onclick');
            contentSubNav.removeAttribute('onmouseenter');
            contentSubNav.removeAttribute('onmouseout');
            setTimeout(function(){
                if(!contentSub.classList.contains('active')){
                    contentSub.innerHTML = '';
                }
            }, 500);

            imageStore = null;
            imageStore2 = null;
        }else if(!contentSub.classList.contains('active')){
            for(var i = 0; i < contentMain.children.length; i++){
                contentMain.children[i].classList.add('disabled');
            }
            // contentMain.style.setProperty('cursor', 'pointer');
            contentMain.style.setProperty('filter', 'blur(0.02rem)');
            contentMain2.style.setProperty('filter', 'blur(0.02rem)');
            contentSub.classList.add('active');
            contentSubNav.classList.add('active');
            contentInject(menuSel, articleid);
            setTimeout(function(){
                // contentSubNav.setAttribute("onclick", "contentControl(true, true);");
                contentSubNav.setAttribute("onmouseover", "document.getElementById('dashboard-content-sub').classList.add('escapePrompt'); document.getElementById('dashboard-content-sub-nav').classList.add('escapePrompt');");
                contentSubNav.setAttribute("onmouseout", "document.getElementById('dashboard-content-sub').classList.remove('escapePrompt'); document.getElementById('dashboard-content-sub-nav').classList.remove('escapePrompt');");
            }, 0); //500
        }
    }else if(menuSel){
        if(contentSel){
            // document.getElementsByTagName('SECTION')[0].classList.remove('unobstructive');
            document.getElementById('dashboard-content').innerHTML = '';
            document.getElementById('dashboard-content').classList.remove('active');
            document.getElementById('dashboard-nav-container').classList.remove('no-wrap');
            document.getElementById('dashboard-nav-menu-' + contentSel).classList.remove('active');
            // document.getElementById('dashboard-nav-greet').classList.remove('max-height');
            contentPage = null;
        }
        if(contentSel != menuSel){
            // setTimeout(function(){document.getElementsByTagName('SECTION')[0].classList.add('unobstructive')}, 500);
            document.getElementById('dashboard-nav-menu-' + menuSel).classList.add('active');
            document.getElementById('dashboard-nav-container').classList.add('no-wrap');
            document.getElementById('dashboard-content').classList.add('active');
            // document.getElementById('dashboard-nav-greet').classList.add('max-height');
            contentSel = menuSel;
            contentInject(contentSel);
        }else{
            contentSel = null;
        }
    }
}

contentNavControl = function(file){
    document.getElementById('dashboard-content-sub-nav-childnode-edit').classList.add('hidden');
    document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.add('hidden');
    document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.add('hidden');
    document.getElementById('dashboard-content-sub-nav-childnode-delete').classList.add('hidden');

    if(file == 'library'){
        // watch
        document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.remove('hidden');
    }else if(file == 'cart' || (file == 'browse' || file == 'browse-sub')){
        // add to cart
        document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.remove('hidden');
        if((file == 'browse' || file == 'browse-sub') && user['accrisk'] == 1){
            document.getElementById('dashboard-content-sub-nav-childnode-edit').classList.remove('hidden');
            document.getElementById('dashboard-content-sub-nav-childnode-delete').classList.remove('hidden');
            isDeletePrompt = false;
            articleDeleteControl();
        }
    }else if(file == 'browse-sub-insert' && user['accrisk'] == 1){
        // disable all icons except edit icon
        document.getElementById('dashboard-content-sub-nav-childnode-edit').classList.remove('hidden');
    }
}

contentInject = function(file, articleid){
    if(file){
        fetch(root + "dashboard/include/" + file + '.php', {
            method: 'post'
        })
        .then(var01 => var01.text())
        .then(function(var01){
            if(articleid){
                // file is a sub content
                document.getElementById('dashboard-content-sub').innerHTML = var01;
                if(articleid === true){
                    if(file == 'transaction'){
                        //perform checkout
                        if(contentPage == 'cart'){
                            transactionControl('checkout', false);
                        }else if(contentPage == 'profile'){
                            transactionControl('payment', false);
                        }
                        //disable cart icon
                        contentNavControl(file);
                    }else if(file == 'browse-sub-insert'){
                        articleInsertControl(null);
                        contentNavControl(file);
                    }
                    // else if(file == 'browse-sub-insert'){
                    //     //disable all the icons except for edit icon
                    //     contentNavControl(file);
                    //     document.getElementById('dashboard-content-sub-nav-childnode-back').setAttribute()
                    // }
                }else if(file == 'browse-sub'){
                    if(contentPage == 'library'){
                        contentNavControl(contentPage);
                    }else if(file == 'browse-sub' && contentPage == 'browse'){
                        contentNavControl(file);
                    }
                    //default to article inject
                    articleInject(articleid, true);
                    if(contentPage == 'cart'){
                        // reset the nav button as transaction checkout may override this
                        contentNavControl('cart');
                    };
                }
            }else{
                document.getElementById('dashboard-content').innerHTML = var01;
                contentPage = file;
                contentNavControl(contentPage);

                if(file == 'browse'){
                    // browse is main and default
                    articleControl(false);
                }else if(file == 'library'){
                    // articleControl(false, file);
                    libraryServer();
                }else if(file == 'cart'){
                    // cartServer();
                    articleControl(false, file);
                }else if(file == 'profile'){
                    userControl(false, true);
                }
            }
        })
        .catch(function(var01){
            contentControl(contentSel);
            console.log(var01);
        });
    }
}
