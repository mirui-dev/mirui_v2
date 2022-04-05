
var globalArticle = null;
var globalArticle2 = null;

articleServer = function(page, mode, data, passingdata){
    var fetchData = new URLSearchParams();

    if(page && page.includes('risk-') && mode && user['accrisk'] === true){
        fetchData.append('risk', mode);
        fetchData.append('raw', data);
        // console.log(data);

        fetch(root + "core/article/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
            body: fetchData
        })
        .then(Response => Response.json())
        .then(function(var01){
            if(var01.status == 'ok' && var01.raw){
                //operation succeded
                // expected to have a list of complete latest articles, so direct update list
                // note: we assume that editing is only allowed in 'browse' page
                globalArticle = var01.raw;
                if(page === 'risk-articleEdit' && contentPage == 'browse'){
                    // refresh browse list (direct inject, assuming edit is only allowed in browse)
                    articleControl(true);
                    // perform search since we already reinject the articles
                    articleSearch();
                    // refresh the sub content section since we are editing
                    // contentControl('browse-sub', )

                    // callback
                    articleEditServer(passingdata, true);
                }else if(page === 'risk-articleInsert' && contentPage == 'browse'){
                    articleControl(true);
                    // clear the search
                    document.getElementById('browse-search-input').value = '';
                    articleSearch();
                    // callback
                    articleInsertServer(true);
                }else if(page === 'risk-articleDelete' && contentPage == 'browse'){
                    articleControl(true);
                    articleSearch();
                    articleDeleteServer(true);
                }
                
            }else{
                // this does not look good
                if(page === 'risk-articleEdit' && contentPage == 'browse'){
                    // callback
                    articleEditServer(passingdata, false);
                }else if(page === 'risk-articleInsert' && contentPage == 'browse'){
                    // callback
                    articleInsertServer(passingdata, false);
                }else if(page === 'risk-articleDelete' && contentPage == 'browse'){
                    // callback
                    articleDeleteServer(false);
                }
            }
        })
        .catch(function(var01){
            // console.log(var01);
            // callback
            // articleEditServer(passingdata, false);
            if(page === 'risk-articleEdit' && contentPage == 'browse'){
                // callback
                articleEditServer(passingdata, false);
            }else if(page === 'risk-articleInsert' && contentPage == 'browse'){
                // callback
                articleInsertServer(passingdata, false);
            }else if(page === 'risk-articleDelete' && contentPage == 'browse'){
                // callback
                articleDeleteServer(false);
            }
        });
    }else{
        fetch(root + "core/article/", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            }, 
        })
        .then(Response => Response.json())
        .then(function(var01){
            if(var01.status == 'ok'){
                //update global article
                globalArticle = var01.raw;
                if(page == 'dashboard'){
                    // cartControl('maintenance');
                    if(mode){
                        articleControl(true, mode);
                    }else{
                        articleControl(true);
                    }
                }else if(page == 'root'){
                    // for home page
                    rootArticleControl(false);
                }
            }else{
                // append no image icon
                if(page == 'root'){
                    // for home page
                    rootArticleControl(false);
                }
            }
        })
        .catch(function(var01){
            // console.log(var01);
        });
    }
}
