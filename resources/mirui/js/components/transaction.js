
transactionServer = function(isPayment){
    contentSubAllowsEscape = false;
    var fetchData = new URLSearchParams();

    if(isPayment){
        // for payment use
        fetchData.append('query', null);
        fetchData.append('coin', parseInt(isPayment));
        fetch(root + "auth/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        .then(var01 => var01.json())
        .then(function(var01){
            contentSubAllowsEscape = true;
            if(var01.status == 'ok'){
                userServer(true);
                transactionControl('complete', false, true);
            }
        })
        .catch(function(var01){
            // dno nothing
            console.log(var01);
        });
    }else{
        // for checkout use
        fetchData.append('cart', cartControl());
        fetch(root + "core/library/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        .then(var01 => var01.json())
        .then(function(var01){
            contentSubAllowsEscape = true;
            if(var01.status == 'ok'){
                userServer(true);
                cartServer();
                libraryServer();
                transactionControl('complete', false, true);
            }
        })
        .catch(function(var01){
            // dno nothing
            console.log(var01);
        });
    }
}
