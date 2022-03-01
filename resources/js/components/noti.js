var notiNum = 0;

injectNoti = function(args01, args02, args03){
    if(args01 && args01.length){
        if(args03){
            var delay = args03;
        }else{
            var delay = 5000;
        }
        var notiElement = document.createElement('div');
        var notiId = "global-noti-element-" + notiNum;
        notiElement.setAttribute('id', notiId);
        notiElement.setAttribute('class', 'global-noti');
        notiElement.setAttribute('onclick', 
            "document.getElementById('"+ notiId +"').parentNode.removeChild(document.getElementById('" + notiId + "'));" + 
            "if(!document.getElementsByClassName('global-noti').length){document.getElementById('global-noti-parent').style.display = 'none';}"
        );
        notiElement.innerHTML = args01;

        document.getElementById('global-noti-parent').insertAdjacentHTML('afterbegin', notiElement.outerHTML);
        document.getElementById('global-noti-parent').style.display = 'flex';
        if(args02 && args02.length){
            document.getElementById(notiId).style.borderBottomColor = args02;
        }
        if(args03!=0){
            setTimeout(function(){
                if(document.getElementById(notiId)){
                    document.getElementById(notiId).style.animation = ".5s notidismiss";
                    document.getElementById(notiId).style.opacity = 0;
                        setTimeout(function(){
                            if(document.getElementById(notiId)){
                                document.getElementById(notiId).parentNode.removeChild(document.getElementById(notiId));
                                if(!document.getElementsByClassName('global-noti').length){
                                    document.getElementById('global-noti-parent').style.display = 'none';
                                }
                            }
                        },400);
                }
            }, delay);
        }
        notiNum++;
    }
}