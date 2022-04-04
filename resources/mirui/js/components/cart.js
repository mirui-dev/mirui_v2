
var userCart = {"item": []};

cartServer = function(articleid){
    if(articleid){
        var fetchData = new URLSearchParams();
        fetchData.append("cart", articleid);

        fetch(root + "core/cart/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        //already json, no need var01.json() anymore
        .then(function(var01){
            if(var01.status != 'ok'){
                cartServer();
            }
        })
        .catch(function(var01){
            // dno nothing
            console.log(var01);
        });
    }else{
        var fetchData = new URLSearchParams();

        fetch(root + "core/cart/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
        })
        .then(var01 => var01.json())
        .then(function(var01){
            if(var01.cart){
                userCart = var01.cart;
                cartCounter();
                if(contentPage && contentSel == 'cart'){
                    // only update article when contentpage is active and is cart page
                    articleControl(false, 'cart');
                }
            }
            if(!contentSel){
                earlyInit(); //onload(1)
            }
        })
        .catch(function(var01){
            // dno nothing
            console.log(var01);
        });
    }
}
