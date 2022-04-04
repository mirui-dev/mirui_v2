
var currentArticleSel = -1;
var visitedArticleSel = [-1];

rootArticleControl = function(isInit, callback){
    if(isInit === true){
        articleServer('root');
    }else if(isInit === false){
        rootArticleInject();
    }
}

rootArticleInject = function(){
    if(globalArticle && globalArticle.length){
        // pick article at random
        var sel = currentArticleSel;
        if(sel == -1){
            visitedArticleSel.shift();
        }
        while(sel == currentArticleSel || visitedArticleSel.includes(sel)){
            sel = parseInt(intRand(globalArticle.length));
        }
        currentArticleSel = sel;
        visitedArticleSel.push(sel);
        if(visitedArticleSel.length == globalArticle.length){
            visitedArticleSel = [];
        }

        if(globalArticle[sel]['title'].length){
            document.getElementById('global-article-title').innerHTML = globalArticle[sel]['title'];
        }
        if(globalArticle[sel]['title2'].length){
            document.getElementById('global-article-subtitle').innerHTML = globalArticle[sel]['title2'];
        }
        if(globalArticle[sel]['description'].length){
            document.getElementById('global-article-body').innerHTML = globalArticle[sel]['description'];
        }

        if(globalArticle[sel]['visual']){
            if(globalArticle[sel]['visual']['cover']){
                document.getElementById("global-article-parent").classList.add('core-imageControl-' + globalArticle[sel]['visual']['cover'].toLowerCase());
                document.getElementById("global-article-parent").style.setProperty('--global-article-background', 'var(--core-imageControl-' + globalArticle[sel]['visual']['cover'].toLowerCase() + ')');
                document.getElementById("global-nav").classList.add('core-imageControl-' + globalArticle[sel]['visual']['cover'].toLowerCase());
                document.getElementById("global-nav").style.setProperty('--global-article-background', 'var(--core-imageControl-' + globalArticle[sel]['visual']['cover'].toLowerCase() + ')');
                imageControl(globalArticle[sel]['visual']['cover'].toLowerCase());
                document.getElementById('global-article-container').getElementsByTagName('a')[1].href = "./watch?v=" + globalArticle[sel]['articleid'].toLowerCase();
            }
        }

        // document.getElementById("global-article-parent").style.setProperty('--global-article-background', "url(./../../../src/img/background/weathering-hero.jpg)");
        // document.getElementById("global-nav").style.setProperty('--global-article-background', "url(./../../../src/img/background/weathering-hero.jpg)");

        toggleLightUi(true);
    }
}


// injectArticle = function(message){
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200 && message) {
//             // Typical action to be performed when the document is ready:
//             // document.getElementById("demo").innerHTML = xhttp.responseText;
//             document.getElementById("global-article-parent").style.setProperty('--global-article-background', "url(./../../../src/img/background/weathering-hero.jpg)");
//             document.getElementById("global-article-parent").style.setProperty('--global-article-background-position', "center");

//             document.getElementById("global-nav").style.setProperty('--global-article-background', "url(./../../../src/img/background/weathering-hero.jpg)");
//             document.getElementById("global-nav").style.setProperty('--global-article-background-position', "center");

//             toggleLightUi(true);
//             document.getElementById("global-article-title").innerHTML = "Weathering With You";
//             document.getElementById("global-article-subtitle").innerHTML = "天気の子";
//             document.getElementById("global-article-body").innerHTML = "The summer of his high school freshman year, Hodaka runs away from his remote island home to Tokyo, and quickly finds himself pushed to his financial and personal limits. The weather is unusually gloomy and rainy every day, as if to suggest his future. He lives his days in isolation, but finally finds work as a writer for a mysterious occult magazine. Then one day, Hodaka meets Hina on a busy street corner. This bright and strong-willed girl possesses a strange and wonderful ability: the power to stop the rain and clear the sky... ";
//         }
//     };
//     xhttp.open("GET", "", true);
//     xhttp.send();
// }
//
// preloadArticle = function(){
//     // seems to work as intended on chrome only, might as well consider removing this
//     document.getElementById("global-article-parent").style.setProperty('--global-article-preload-background', "url(./../../../src/img/background/weathering-hero.jpg)");
// }
