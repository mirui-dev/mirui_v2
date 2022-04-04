
userControl = function(isInject, mode){
    if(isInject === false && mode === false){
        injectNoti('<p>Failed to retrieve user profile. Consult administrator for more information. </p>', null, 6000);
    }else if(!isInject && mode){
        // fetch first so not injecting yet
        userServer(mode);
    }else if(isInject && mode === true){
        userInject(true);
        // then we inject avatar, not injecting together prevent waiting
        if(userAvatar == null){
            userControl(false, 'avatar');
        }else{
            userControl(true, 'avatar');
        }
    }else if(isInject && mode == 'avatar'){
        userInject('avatar');
    }
}

userInject = function(mode){
    var nodeUsername = document.getElementById('profile-overview-usercard-details-greeter-username');
    var nodeCoin = document.getElementById('profile-overview-usercard-details-coin');
    var nodeAvatar = document.getElementById('profile-overview-usercard-details-avatar');

    if(mode == 'avatar'){
        // inject the avatar
        if(userAvatar != null){
            var nodeAvatar = document.getElementById('profile-overview-usercard-details-avatar').style.backgroundImage = 'url("' + userAvatar + '")';
        }

        // assume final stage of injection, let's reveal the usercard
        document.getElementById('profile-overview-usercard').classList.remove('disabled');
    }else if(mode === true){
        // inject user info
        nodeUsername.innerHTML = user['name'].trim();
        nodeCoin.innerHTML = "You have " + user['coin'] + " coin(s) remaining. Click here to add coins. ";
    }
}

// BEGIN userAvatar

userAvatarControl = function(callback){
    var userAvatarNew = null;
    if(callback === undefined){
        var imageSwitch = document.getElementById('profile-overview-usercard-details-avatar-core');
        // imgtest = imageSwitch;
        if(imageSwitch.files && imageSwitch.files.length){
            // var imageSel = imageSwitch.files[0]['type'];

            // check file type
            if(imageSwitch.files[0]['type'].indexOf('image/') === 0){
                // it is an image, OK

                // check file size
                if(imageSwitch.files[0]['size'] < 16777216){
                    // file size below 16MB, OK

                    //prepare file reader
                    var imageReaderRAW  = new FileReader();
                    
                    // for preview just use object URL, cannot use base64 because too long
                    // var imageStoreObject = URL.createObjectURL(imageSwitch.files[0]);
                    // if(type == 'cover'){
                    //     coverElement = document.getElementById('browse-sub-cover');
                    //     coverElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), url(' + imageStoreObject + ')');
                    // }

                    // NO NEED PREVIEW LIAU LA...

                    // this is for the RAW one
                    imageReaderRAW.readAsBinaryString(imageSwitch.files[0]);
                    imageReaderRAW.addEventListener("load", function () {
                        userAvatarNew = btoa(imageReaderRAW.result);
                        // console.log(imageStore[type]);
                        if(userAvatarNew != null && userAvatarNew != undefined){
                            injectNoti('<p>Uploading profile picture... ヾ( `ー´)シφ__', null, 6000);
                            userAvatarServer(userAvatarNew);
                        }else{
                            injectNoti('<p>An error occured while processing image upload. <br><br>Changes discarded. </p>', null, 8000);
                        }
                    }, false);

                }else{
                    injectNoti('<p>Oi, your profile picture too big already la! (╬ Ò﹏Ó)<br><br><strong>16MB MAXIMUM HELLO</strong></p>', null, 8000);
                    // clear file selection
                    imageSwitch.value = null;
                }
            }else{
                injectNoti('<p>Invalid image. Ensure that the image is an image... (o-_-o)', null, 6000);
                // clear file selection
                imageSwitch.value = null;
            }
            
        }
        // console.log(type);
        // console.log(imageSwitch.files);
    }else if(callback === true){
        injectNoti('<p>Upload successss!!! („• ֊ •„)', null, 6000);
        userControl(false, 'avatar');
    }else if(callback === false){
        injectNoti('<p>An error occured while saving picture. <br>Changes discarded. </p>', null, 8000);
    }
}
