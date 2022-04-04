var isNav = 0;

global_nav_toggleNav = function(){
    if(isNav){
        setTimeout(function(){document.getElementById('global-nav').style.display = "none"}, 400);
        document.getElementById('global-nav').style.opacity = 0;
        isNav = 0;
    }else{
        document.getElementById('global-nav').style.display = "flex";
        document.getElementById('global-nav').style.opacity = 1;
        isNav = 1;
    }
}