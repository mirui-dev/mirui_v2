
articleControl = function(isInject, mode){
    globalArticle2 = null;
    if(!isInject){
        // fetch first so not injecting yet
        if(mode){
            articleServer('dashboard', mode);
        }else{
            articleServer('dashboard');
        }
    }else if(isInject && mode){
        globalArticle2 = articleFilter(mode);
        articleInject(globalArticle2);
    }else if(isInject){
        // update cart to delete non-existence item
        cartControl('maintenance');
        // var globalArticle2 = articleFilter();
        globalArticle2 = null;
        articleInject(articleFilter());
    }
}

articleInject = function(articleid, isSub){
    if(articleid && isSub){
        //articleid is not array
        articleid = articleid.toLowerCase();
        for(var i = 0; i < globalArticle.length; i++){
            if(globalArticle[i]['articleid'].toLowerCase() == articleid){
                // control nav cart button
                cartButtonControl(articleid);
                document.getElementById('dashboard-content-sub-nav-childnode-cart').setAttribute('onclick', "cartControl('" + articleid + "')");

                // control tide button
                document.getElementById('dashboard-content-sub-nav-childnode-edit').setAttribute('onclick', "articleEditControl('" + articleid + "')");
                articleEditState = false;

                // control eteled button
                document.getElementById('dashboard-content-sub-nav-childnode-delete').setAttribute('onclick', "articleDeleteControl('" + articleid + "', true)");
                articleDeletePrompt = false;

                // control watch button
                document.getElementById('dashboard-content-sub-nav-childnode-watch').setAttribute('onclick', "window.open('" +  root + "watch?v=" + articleid + "')")

                var currentElement = document.getElementById('browse-sub-cover');
                if(globalArticle[i]['rating'].length){
                    document.getElementById('browse-sub-cover-details-rating').innerHTML = globalArticle[i]['rating'];
                }
                document.getElementById('browse-sub-cover-details-score').innerHTML = parseFloat(globalArticle[i]['score']).toFixed(1);
                if(globalArticle[i]['title'].length){
                    document.getElementById('browse-sub-cover-details-title').innerHTML = globalArticle[i]['title'];
                }
                if(globalArticle[i]['title2'].length){
                    document.getElementById('browse-sub-cover-details-title2').innerHTML = globalArticle[i]['title2'];
                }
                if(globalArticle[i]['description'].length){
                    document.getElementById('browse-sub-cover-details-desc').innerHTML = globalArticle[i]['description'];
                }
                if(globalArticle[i]['description2'].length){
                    document.getElementById('browse-sub-section-main-details-desc2').innerHTML = globalArticle[i]['description2'];
                }
                var articleDate = new Date(globalArticle[i]['reldate']);
                document.getElementById('browse-sub-section-sidebar-details-year').innerHTML = articleDate.getFullYear();
                document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML = parseFloat(globalArticle[i]['score']).toFixed(1);
                if(globalArticle[i]['lang']){
                    if(globalArticle[i]['lang']['lang'] && globalArticle[i]['lang']['lang'].length){
                        document.getElementById('browse-sub-section-sidebar-details-lang').innerHTML = globalArticle[i]['lang']['lang'].join(' ');
                    }
                }
                if(globalArticle[i]['subtitle']){
                    if(globalArticle[i]['subtitle']['lang'] && globalArticle[i]['subtitle']['lang'].length){
                        document.getElementById('browse-sub-section-sidebar-details-subtitle').innerHTML = globalArticle[i]['subtitle']['lang'].join(' ');
                    }
                }
                document.getElementById('browse-sub-section-sidebar-details-duration').innerHTML = globalArticle[i]['runtime'] + 'm';
                if(globalArticle[i]['genre']){
                    if(globalArticle[i]['genre']['tags'] && globalArticle[i]['genre']['tags'].length){
                        document.getElementById('browse-sub-section-sidebar-details-genre').innerHTML = globalArticle[i]['genre']['tags'].join(' ');
                    }
                }
                if(globalArticle[i]['country'].length){
                    document.getElementById('browse-sub-section-sidebar-details-country').innerHTML = globalArticle[i]['country'];
                }
                if(globalArticle[i]['director'].length){
                    document.getElementById('browse-sub-section-sidebar-details-director').innerHTML = globalArticle[i]['director'];
                }
                if(globalArticle[i]['cast']){
                    if(globalArticle[i]['cast']['star'] && globalArticle[i]['cast']['star'].length){
                        document.getElementById('browse-sub-section-sidebar-details-cast').innerHTML = globalArticle[i]['cast']['star'].join('<br>');
                    }
                }
                if(globalArticle[i]['visual']){
                    if(globalArticle[i]['visual']['cover']){
                        currentElement.classList.add('core-imageControl-' + globalArticle[i]['visual']['cover'].toLowerCase());
                        currentElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), var(--core-imageControl-' + globalArticle[i]['visual']['cover'].toLowerCase() + ')');
                        imageControl(globalArticle[i]['visual']['cover'].toLowerCase());
                    }
                }
                i = globalArticle.length;
            }
        }
    }else if(articleid){
        //articleid is array
        // if(globalArticle2){
        //     articleid = globalArticle2;
        // }

        if(document.getElementById('browse-gallery').childNodes.length){
            //prevent duplication
            document.getElementById('browse-gallery').innerHTML = '';
        }
        for(var i = 0; i < articleid.length; i++){
            // if(articleid[i]['visible'] == 1){
                articleNode(i, articleid[i]['articleid'].toLowerCase());
                if(articleid[i]['visible'] == 1 || user['accrisk'] === true){
                    var currentElement = document.getElementById('browse-gallery-node-' + i);
                    currentElement.getElementsByClassName('browse-gallery-node-score')[0].innerHTML = parseFloat(articleid[i]['score']).toFixed(1);
                    currentElement.getElementsByClassName('browse-gallery-node-details-title')[0].innerHTML = articleid[i]['title'];
                    if(JSON.stringify(articleid[i]['visual']) != '{}'){
                        if(articleid[i]['visual']['poster']){
                            currentElement.classList.add('core-imageControl-' + articleid[i]['visual']['poster'].toLowerCase());
                            currentElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), var(--core-imageControl-' + articleid[i]['visual']['poster'].toLowerCase() + ')');
                            imageControl(articleid[i]['visual']['poster'].toLowerCase());
                        }
                    }
                    if(articleid[i]['visible'] != 1){
                        currentElement.classList.add('disabled');
                    }
                }
            // }
        }
    }
}

articleNode = function(articleCount, articleid){
    if(articleCount != null){
        var browseGallery = document.getElementById('browse-gallery');
        var nodeArray = [];
        var articleArray = globalArticle;
        if(globalArticle2){
            articleArray = globalArticle2;
        }
        if(articleArray[articleCount]['visible'] == 1 || user['accrisk'] === true){
            nodeArray.push('<div id="browse-gallery-node-' + articleCount + '" class="browse-gallery-node flex" onclick="contentControl('+"'browse-sub', '"+ articleid +"'"+')">');
                nodeArray.push('<span class="browse-gallery-node-score content-width"></span>');
                nodeArray.push('<div class="browse-gallery-node-details flex max-height fill-width">');
                    nodeArray.push('<h1 class="browse-gallery-node-details-title">');
                    nodeArray.push('</h1>');
                nodeArray.push('</div>');
        }else{
            nodeArray.push('<div id="browse-gallery-node-' + articleCount + '">');
        }
        nodeArray.push('</div>');
        browseGallery.insertAdjacentHTML('beforeend', nodeArray.join(''));
    }
}

articleFilter = function(mode){
    var ret = [];
    if(mode == 'library'){
        for(var i = 0; i < globalArticle.length; i++){
            userLibrary['library'].forEach(function(count){
                if(count['articleid'].toUpperCase() == globalArticle[i]['articleid'].toUpperCase()){
                    ret.push(globalArticle[i]);
                }
            })
        }
    }else if(mode == 'cart'){
        for(var i = 0; i < globalArticle.length; i++){
            if(cartControl().toString().toUpperCase().search(globalArticle[i]['articleid'].toUpperCase()) != -1){
                ret.push(globalArticle[i]);
            }
        }
        if(contentPage && contentSel == 'cart'){
            cartCounter();
        }
    }else{
        ret = globalArticle;
    }
    return ret;
}

articleSearch = function(){
    try{
        var sterm = document.getElementById('browse-search-input').value.toLowerCase().split(' ');
        var localArticle = globalArticle;
        if(globalArticle2){
            localArticle = globalArticle2;
        }
        var childmatch = false;
        if(sterm.length){
            // perform all search
            for(var i = 0; i < localArticle.length; i++){
                for(var j = 0; j < sterm.length; j++){
                    var tmpterm = sterm[j].trim();
                    // console.log(tmpterm);
                    var articleDate = new Date(localArticle[i]['reldate']);
                    var articleGenre = '';
                    var articleCast = '';
                    if(localArticle[i]['genre']){
                        if(localArticle[i]['genre']['tags'] && localArticle[i]['genre']['tags'].length){
                            articleGenre = localArticle[i]['genre']['tags'].toString().toLowerCase();
                        }
                    }
                    if(localArticle[i]['cast']){
                        if(localArticle[i]['cast']['star'] && localArticle[i]['cast']['star'].length){
                            articleCast = localArticle[i]['cast']['star'].toString().toLowerCase();
                        }
                    }
                    if(
                        localArticle[i]['title'].toLowerCase().search(tmpterm) != -1
                        || localArticle[i]['title2'].toLowerCase().search(tmpterm) != -1
                        // || (globalArticle[i]['genre']['tags'].toString().toLowerCase().search(tmpterm) != -1)
                        || articleGenre.search(tmpterm) != -1
                        || localArticle[i]['country'].toLowerCase().search(tmpterm) != -1
                        || ((localArticle[i]['score'][0] == tmpterm.replace('.','') && tmpterm.length <= 2) || localArticle[i]['score'] == tmpterm || ((localArticle[i]['score'].length == 1 || localArticle[i]['score'].length == 2) && localArticle[i]['score'] + '.0' == tmpterm))
                        || localArticle[i]['director'].toLowerCase().search(tmpterm) != -1
                        // || globalArticle[i]['cast']['star'].toString().toLowerCase().search(tmpterm) != -1
                        || articleCast.search(tmpterm) != -1
                        || articleDate.getFullYear().toString().search(tmpterm) != -1
                        // special: match 'anime' with animation genre
                        || (tmpterm == 'anime' && articleGenre.search('animation') != -1)
                    ){
                        if(j == 0 && !childmatch){
                            childmatch = true;
                        }else if(!childmatch){
                            childmatch = false;
                        }
                    }else{
                        childmatch = false;
                    }
                }
                if(!childmatch){
                    document.getElementById('browse-gallery-node-' + i).style.setProperty('display', 'none');
                }else{
                    document.getElementById('browse-gallery-node-' + i).style.removeProperty('display');
                }
            }
        }
    }catch(e){
        // console.log(e);
    }
}
