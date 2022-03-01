
var root = './';
var user = null;
var earlyInitVar = 0;

earlyInit = function(check){
    if(earlyInitVar < 3 && !check){
       earlyInitVar++; 
       earlyInit(true);
    }else if(earlyInitVar >= 3){
        greetInject();
        document.getElementById('dashboard-nav-container').classList.remove('disabled');
    }
}

toggleLightUi = function(isLightUi){
    if(document.getElementsByTagName('body')[0].classList.contains('need-lightui') && !isLightUi){
        document.getElementsByTagName('body')[0].classList.remove('need-lightui');
    }else if(!document.getElementsByTagName('body')[0].classList.contains('need-lightui') && isLightUi){
        document.getElementsByTagName('body')[0].classList.add('need-lightui');
    }
}

textTrim = function(string){
    if(string){
        return string.replaceAll('<br>',' ').replace(/&nbsp;+/g,' ').replace(/\s+/g,' ').trim();
    }
    return null;
}

textTrim2 = function(string){
    if(string){
        return string.replace(/&nbsp;+/g,' ').trim();
    }
    return null;
}

// reference: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
intRand = function(max){
    return Math.floor(Math.random() * Math.floor(max));
}
