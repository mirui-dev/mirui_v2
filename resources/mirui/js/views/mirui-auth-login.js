var loginSuccess = 0;

document.getElementById('auth-login-form').addEventListener('keypress', function (e) {
    if (e.key === 'Enter' && !loginSuccess) {
        loginPerform();
    }
});

loginValidate = function(){
    return eval(document.getElementById('auth-login-form-username').value != '' && document.getElementById('auth-login-form-password').value != '');
}

loginPerform = function(){
    if (loginValidate()){
        document.getElementById('auth-login-parent').classList.add('disabled');
        document.getElementById('auth-login-form-username').blur();
        document.getElementById('auth-login-form-password').blur();

        var auth_username = document.getElementById('auth-login-form-username').value;
        var auth_password = document.getElementById('auth-login-form-password').value;

        var fetchData = new URLSearchParams();
        fetchData.append("auth", "0");
        fetchData.append("auth-username", auth_username);
        fetchData.append("auth-password", auth_password);

        fetch(root + "auth/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        .then(Response => Response.json())
        .then(function(var01){
            if(var01.isAuth == true){
                // document.getElementById('auth-login-parent').classList.remove('disabled'); //no need enable back form since we are redirecting user
                injectNoti("<p>Login successful. </p>", 'darkgreen');
                loginSuccess = 1;
                setTimeout(function(){
                    window.location.replace("./../../dashboard/");
                }, 1000);
            }else{
                document.getElementById('auth-login-parent').classList.remove('disabled');
                document.getElementById('auth-login-form-password').focus();
                injectNoti("<p>Incorrect login credentials. Please try again later or contact customer service for account recovery. </p>", 'darkred');
            }
        })
        .catch(function(var01){
            document.getElementById('auth-login-parent').classList.remove('disabled');
            injectNoti("<p>Login failed. Please try again later. </p>", 'darkred');
            console.log(var01);
        });

    }else{
        document.getElementById('auth-login-parent').classList.remove('disabled');
        injectNoti("<p>Invalid login credentials. Please try again later. </p>", 'darkred');
    }
}

