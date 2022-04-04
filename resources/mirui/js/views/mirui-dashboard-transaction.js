
transactionControl = function(level, isInjected, isProcess){
    if(!isInjected && isProcess){
        transactionBuffer(true);
        if(level == 'checkout'){
            transactionServer(false);
        }else if(level == 'payment'){
            if(transactionPaymentInputControl(true)){
                transactionServer(transactionPaymentInputControl(true));
            }else{
                transactionBuffer(10);
            }
        }else if(level == 'complete'){
            transactionInject(level);
        }
    }else if(!isInjected){
        // at landing
        transactionBuffer(true);
        transactionInject(level);
    }else if(isInjected && level){
        var progressCount = 10;
        if(level == 'payment'){
            // progressCount = 40;
        }else if(level == 'complete'){
            progressCount = false;
        }
        setTimeout(function(){
            transactionBuffer(progressCount);
            document.getElementById('transaction-content-progress-label').innerHTML = level.toUpperCase();
        }, 750);
    }
}

transactionInject = function(file){
    if(file){
        fetch(root + "dashboard/include/" + 'transaction-' + file + '.php', {
            method: 'post'
        })
        .then(var01 => var01.text())
        .then(function(var01){
            document.getElementById('transaction-content-container').innerHTML = var01;
            if(file == 'checkout'){
                var coinConsume = (cartCounter()*5);
                var message = "You have " + cartCounter() + " movie(s) in cart";
                if(user['coin'] >= coinConsume){
                    message += " ready for checkout. ";
                    var buttonText = "PAY WITH " + coinConsume + " COINS";
                }else{
                    message += ", however your coins balance is low. "
                    var buttonText = "ADD COIN FIRST ._>";
                    document.getElementById('transaction-content-checkout-prompt-next').classList.add('disabled');
                }
                document.getElementById('transaction-content-checkout-summary-text').innerHTML = message;
                document.getElementById('transaction-content-checkout-prompt-next').innerHTML = buttonText;
            }
            transactionControl(file, true);
        })
        .catch(function(var01){
            console.log(var01);
        });
    }
}

transactionBuffer = function(isLoop){
    if(isLoop === true){
        document.getElementById('transaction-content-container').classList.add('disabled');
        // document.getElementById('dashboard-content-sub-nav-childnode-back').classList.add('disabled');
        // contentSubAllowsEscape = false;
    }else{
        document.getElementById('transaction-content-container').classList.remove('disabled');
        // document.getElementById('dashboard-content-sub-nav-childnode-back').classList.remove('disabled');
        // contentSubAllowsEscape = true;
    }
    transactionBufferProgress(isLoop);
}

transactionBufferProgress = function(progress){
    if(progress === true){
        document.getElementById('transaction-content-progress-bar').classList.add('isBuffering');
    }else{
        document.getElementById('transaction-content-progress-bar').classList.remove('isBuffering');
        if(progress === false){
            document.getElementById('transaction-content-progress-bar').style.setProperty('width', '100%');
        }else{
            document.getElementById('transaction-content-progress-bar').style.setProperty('width', progress + '%');
        }
    } 
}

transactionPaymentControl = function(){

}

transactionPaymentInputControl = function(mode, type){
    var nodeCoin = document.getElementById('transaction-content-payment-coin');
    var nodeCNumber = document.getElementById('transaction-content-payment-cnumber');
    var nodeCDate = document.getElementById('transaction-content-payment-cdate');
    var nodeCCVV = document.getElementById('transaction-content-payment-ccvv');

    if(mode == 'input' && type){
        // format card number
        if(type == 'cnumber'){
            nodeCNumber.value = nodeCNumber.value.trim();
            if(nodeCNumber.value.length == 4 || nodeCNumber.value.length == 9 || nodeCNumber.value.length == 14){
                nodeCNumber.value += ' ';
            }
            // for(var i = 0, j = 1; i < nodeCNumber.value.length; i++){
            //     if(i == (4*j)+1){
            //         nodeCNumber.value[i-1] += ' ';
            //         i++;j++;
            //     }
            // }
        }else if(type == 'cdate'){
            nodeCDate.value = nodeCDate.value.trim();
            if(nodeCDate.value.length == 2){
                nodeCDate.value += '/';
            }
        }else if(type == 'ccvv'){
            nodeCCVV.value = nodeCCVV.value.trim();
        }else if(type == 'coin'){
            nodeCoin.value = nodeCoin.value.trim();
        }
    }else if(mode === true){
        if(parseInt(nodeCoin.value) < 5 || nodeCoin.value == ''){
            injectNoti('<p>Minimum topup amount of coin is 5. </p>', null, 6000);
        }else if(parseInt(nodeCoin.value) && parseInt(nodeCNumber.value) && parseInt(nodeCDate.value) && parseInt(nodeCCVV.value) && nodeCNumber.value.length == nodeCNumber.getAttribute('maxlength') && nodeCDate.value.length == nodeCDate.getAttribute('maxlength') && nodeCCVV.value.length == nodeCCVV.getAttribute('maxlength')){
            return parseInt(nodeCoin.value);
        }else{
            injectNoti('<p>Invalid payment details. Ensure that payment details are correct. </p>', null, 6000);
        }
        return false;
    }
}
