var registerSuccess = 0;

document.getElementById('auth-new-form').addEventListener('keypress', function (e) {
    if (e.key === 'Enter' && !registerSuccess) {
        newPerform();
    }
});

// validate name
document.getElementById('auth-new-form-name').addEventListener("input", function(){newValidate2('name');});
document.getElementById('auth-new-form-name').addEventListener("blur", function(){newValidate2('name', 1);});

// validate username
document.getElementById('auth-new-form-username').addEventListener("input", function(){newValidate('username');});
document.getElementById('auth-new-form-username').addEventListener("blur", function(){newValidate2('username', 1);});

// validate password
var isPwdCon = 0;
document.getElementById('auth-new-form-password').addEventListener("input", function(){newValidate2('password');});
document.getElementById('auth-new-form-password-confirm').addEventListener("input", function(){isPwdCon++;newValidate2('password');});
document.getElementById('auth-new-form-password').addEventListener("blur", function(){newValidate2('password', 1);});
document.getElementById('auth-new-form-password-confirm').addEventListener("blur", function(){newValidate2('password', 1);});

// validate email
document.getElementById('auth-new-form-email').addEventListener("input", function(){newValidate('email');});
document.getElementById('auth-new-form-email').addEventListener("blur", function(){newValidate2('email', 1);});


newValidate = function(valType, isNotify){
    
    var fetchData = new URLSearchParams();
    fetchData.append("auth", "2");

    var new_username  = document.getElementById('auth-new-form-username').value;
    var new_email  = document.getElementById('auth-new-form-email').value;

    // if(args01){
    //     if(args01 == 'username'){
    //         fetchData.append("new-username", new_username);
    //     }else if(args01 == 'email'){
    //         fetchData.append("new-email", new_email);
    //     }
    // }else{
        fetchData.append("new-username", new_username);
        fetchData.append("new-email", new_email);
    // }

    fetch(root + "auth/", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        }, 
        body: fetchData
    })
    .then(Response => Response.json())
    .then(json => {
        // console.log(json);
        if(json.status == 'ok'){
            if(valType == 'username'){
                if(json.isUniqueUsername){
                    document.getElementById('auth-new-form-username').classList.remove('auth-invalid');
                }else{
                    document.getElementById('auth-new-form-username').classList.add('auth-invalid');
                    if(isNotify){
                        injectNoti("<p>Username has been taken. Please enter again. </p>", 'darkorange');
                    }
                }
            }else if(valType == 'email'){
                if(json.isUniqueEmail){
                    document.getElementById('auth-new-form-email').classList.remove('auth-invalid');
                }else{
                    document.getElementById('auth-new-form-email').classList.add('auth-invalid');
                    if(isNotify){
                        injectNoti("<p>Email has been taken. Please enter again. </p>", 'darkorange');
                    }
                }        
            }else{
                if(json.isUniqueUsername){
                    document.getElementById('auth-new-form-username').classList.remove('auth-invalid');
                }else{
                    document.getElementById('auth-new-form-username').classList.add('auth-invalid');
                    if(isNotify){
                        injectNoti("<p>Username has been taken. Please enter again. </p>", 'darkorange');
                    }
                }
                if(json.isUniqueEmail){
                    document.getElementById('auth-new-form-email').classList.remove('auth-invalid');
                }else{
                    document.getElementById('auth-new-form-email').classList.add('auth-invalid');
                    if(isNotify){
                        injectNoti("<p>Email has been taken. Please enter again. </p>", 'darkorange');
                    }
                } 
                // if(json.isUniqueUsername && json.isUniqueEmail){
                //     document.getElementById('auth-new-form-username').classList.remove('auth-invalid');
                //     document.getElementById('auth-new-form-email').classList.remove('auth-invalid');
                // }else{
                //     document.getElementById('auth-new-form-username').classList.add('auth-invalid');
                //     document.getElementById('auth-new-form-email').classList.add('auth-invalid');
                // }  
            }
        }else if(Response.status == 500){
            document.getElementById('auth-new-form-username').classList.add('auth-invalid');
            document.getElementById('auth-new-form-email').classList.add('auth-invalid');
        }else{
            if(valType == 'username'){
                if(document.getElementById('auth-new-form-username').value == ''){
                    document.getElementById('auth-new-form-username').classList.remove('auth-invalid');
                }
            }else if(valType == 'email'){
                if(document.getElementById('auth-new-form-email').value == ''){
                    document.getElementById('auth-new-form-email').classList.remove('auth-invalid');
                }       
            }else{
                if(document.getElementById('auth-new-form-username').value == ''){
                    document.getElementById('auth-new-form-username').classList.remove('auth-invalid');
                }
                if(document.getElementById('auth-new-form-email').value == ''){
                    document.getElementById('auth-new-form-email').classList.remove('auth-invalid');
                }
            }
        }
    })
    .catch(error => {
        // silent! this is a background process...
        console.log(error);
    });
}

newValidate2 = function(valType, isNotify){

    var new_name = document.getElementById('auth-new-form-name');
    var new_username = document.getElementById('auth-new-form-username');
    var new_password = document.getElementById('auth-new-form-password');
    var new_password_confirm = document.getElementById('auth-new-form-password-confirm');
    var new_email = document.getElementById('auth-new-form-email');

    if(valType){
        if(valType == 'name'){
            if(new_name.validity.valid){
                return true;
            }else{
                if(isNotify){
                    injectNoti("<p>Invalid name. Please enter again. </p>", 'darkorange');
                }
            }
        }else if(valType == 'username'){
            newValidate('username', isNotify);
            if(!new_username.classList.contains('auth-invalid') && new_username.validity.valid){
                return true;
            // }else{
            //     if(args02){
            //         injectNoti("<p>Invalid username. Please enter again. </p>", 'darkorange');
            //     }
            }
        }else if(valType == 'password'){
            if(new_password.value == new_password_confirm.value && new_password.validity.valid && new_password_confirm.validity.valid){
                // new_password.classList.remove('auth-invalid');
                // new_password_confirm.classList.remove('auth-invalid');
                return true;
            }else if(!new_password.validity.valid){
                // new_password.classList.add('auth-invalid');
                // new_password_confirm.classList.add('auth-invalid');
                if(isNotify){
                    injectNoti("<p>Invalid password. Please enter again. </p>", 'darkorange');
                }
            }else{
                // new_password_confirm.classList.add('auth-invalid');
                if(isNotify && isPwdCon){
                    injectNoti("<p>Password do not match. Please enter again. </p>", 'darkorange');
                }
            }
        }else if(valType == 'email'){
            newValidate('email', isNotify);
            if(!new_email.classList.contains('auth-invalid') && new_email.validity.valid){
                return true;
            // }else{
            //     if(args02){
            //         injectNoti("<p>Invalid email. Please enter again. </p>", 'darkorange');
            //     }
            }
        }
    }else{
        if(new_name.validity.valid 
            && !new_username.classList.contains('auth-invalid') && new_username.validity.valid
            && new_password.value == new_password_confirm.value && new_password.validity.valid && new_password_confirm.validity.valid
            && !new_email.classList.contains('auth-invalid') && new_email.validity.valid){
                return true;
            }
    }

    return false;

}

newPerform = function(){
    if (newValidate2()){
        document.getElementById('auth-new-parent').classList.add('disabled');
        document.getElementById('auth-new-form-name').blur();
        document.getElementById('auth-new-form-username').blur();
        document.getElementById('auth-new-form-password').blur();
        document.getElementById('auth-new-form-password-confirm').blur();
        document.getElementById('auth-new-form-email').blur();

        var new_name = document.getElementById('auth-new-form-name').value;
        var new_username = document.getElementById('auth-new-form-username').value;
        var new_password = document.getElementById('auth-new-form-password').value;
        var new_email = document.getElementById('auth-new-form-email').value;

        var fetchData = new URLSearchParams();
        fetchData.append("auth", "1");
        fetchData.append("new-name", new_name);
        fetchData.append("new-username", new_username);
        fetchData.append("new-password", new_password);
        fetchData.append("new-email", new_email);

        fetch(root + "auth/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        .then(Response => Response.json())
        .then(function(var01){
            if(var01.isNew == true){
                // document.getElementById('auth-login-parent').classList.remove('disabled'); //no need enable back form since we are redirecting user
                injectNoti("<p>Account registered. Redirecting to login...</p>", 'darkgreen');
                registerSuccess = 1;
                setTimeout(function(){
                    window.location.replace("./../../auth/login/");
                }, 1000);
            }else{
                document.getElementById('auth-new-parent').classList.remove('disabled');
                document.getElementById('auth-new-form-name').focus();
                injectNoti("<p>Registration failed. Ensure that all details are filled in correctly. </p>", 'darkred');
            }
        })
        .catch(function(var01){
            document.getElementById('auth-new-parent').classList.remove('disabled');
            injectNoti("<p>Registration failed. Please try again later. </p>", 'darkred');
            console.log(var01);
        });

    }else{
        document.getElementById('auth-new-parent').classList.remove('disabled');
        injectNoti("<p>Invalid details. Please try again later. </p>", 'darkred');
    }
}


