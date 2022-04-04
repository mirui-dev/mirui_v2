
// BEGIN articleImage

var imageStore = null;
var imageStore2 = null;

articleImageControl = function(type, isMultisel){
    if(type && (type == 'poster' || type == 'cover') && isMultisel == undefined){
        var imageSwitch = document.getElementById('browse-sub-cover-imagePrompt-' + type);
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
                    var imageStoreObject = URL.createObjectURL(imageSwitch.files[0]);
                    if(type == 'cover'){
                        coverElement = document.getElementById('browse-sub-cover');
                        coverElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), url(' + imageStoreObject + ')');
                    }
                    // this is for the RAW one
                    imageReaderRAW.readAsBinaryString(imageSwitch.files[0]);
                    imageReaderRAW.addEventListener("load", function () {
                        if(imageStore === null){
                            imageStore = {};
                            imageStore['poster'] = null;
                            imageStore['cover'] = null;
                            imageStore['gallery'] = [];
                        }
                        imageStore[type] = btoa(imageReaderRAW.result);
                        // console.log(imageStore[type]);
                    }, false);

                }else{
                    injectNoti('<p>Oi, your picture too big already la! (╬ Ò﹏Ó)<br><br><strong>16MB MAXIMUM HELLO</strong></p>', null, 8000);
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
    }
}

// END articleImage


// BEGIN articleCreate
var articleInsertState = false;

articleInsertControl = function(stage, stage2){
    if(user['accrisk'] === true){
        if(articleInsertState === false){
            // enable insert
            articleInsertInjector(true);
            articleInsertState = true;
            injectNoti('<p>You are now in Create Mode. Click on elements to edit details. </p>', null, 6000);
            articleInsertButtonControl('edit');
        }else if(articleInsertState === true && stage === undefined && stage2 === true){
            //upload file success, let's proceed to save
            articleInsertServer(null, articleInsertCollector()); //pass null for injection
        }else if(articleInsertState === true && stage === undefined && stage2 === false){
            // upload file failed, proceed also but warn that file upload has problem
            articleInsertServer(null, articleInsertCollector()); //pass null for injection
            injectNoti('<p>An error occured while uploading images, therefore images will be excluded from movie details. </p>', null, 6000);
        }else if(articleInsertState === true && stage === 'discard'){
            // discard insert
            articleInsertInjector(false);
            articleInsertState = false;
            injectNoti('<p>Movie discarded. </p>', null, 5000);
            articleInsertButtonControl();
        }else if(articleInsertState === true && stage === undefined){
            // disable insert and save to server (inject)
            articleInsertInjector(false);
            if(articleInsertCollector() !== false){
                articleInsertButtonControl('save');
                // upload images
                if(imageStore != null){
                    imageControl('risk-articleInsert', 'insert', imageStore);
                }else{
                    articleInsertServer(null, articleInsertCollector()); //pass null for injection   
                }
            }else{
                // invalid input detected, fallback to edit mode
                articleInsertInjector(true);
                articleInsertState = true;
                articleInsertButtonControl('edit');
            }
        }else if(articleInsertState === true && stage === true){
            // saved, everything looks good
            articleInsertInjector(false);
            articleInsertState = false;
            injectNoti('<p>Movie saved successfully. </p>', null, 5000);
            articleInsertButtonControl('saved');
            contentControl('browse-sub-insert', true); // contentcontrol is also sub content toggle, thus trigger twice to remain on the sub content container (prevent dismiss)
        }else if(articleInsertState === true && stage === false){
            // no, it does not look good. Fall back to edit mode
            articleInsertInjector(true);
            articleInsertState = true;
            injectNoti('<p>Failed to save changes. Consult administrator for more information. </p>', null, 6000);
            articleInsertButtonControl('edit');
        }
    }
}

articleInsertServer = function(state, articleArray){
    if(state === true){
        // server return success status
        articleInsertControl(true);
    }else if(state === null && articleArray){
        // perform server inject
        articleServer('risk-articleInsert', 'insert', JSON.stringify(articleArray));
    }else if(state === false){
        // server returned fail status
        articleInsertControl(false);
    }
}

articleInsertInjector = function(isInject){
    var elementNode = [
        document.getElementById('browse-sub-cover-details-rating'),
        document.getElementById('browse-sub-cover-details-score'),
        document.getElementById('browse-sub-cover-details-title'),
        document.getElementById('browse-sub-cover-details-title2'),
        document.getElementById('browse-sub-cover-details-desc'),
        // document.getElementById('browse-sub-section-sidebar-details-year'),
        document.getElementById('browse-sub-section-sidebar-details-rating'),
        document.getElementById('browse-sub-section-sidebar-details-lang'),
        document.getElementById('browse-sub-section-sidebar-details-subtitle'),
        document.getElementById('browse-sub-section-sidebar-details-duration'),
        document.getElementById('browse-sub-section-sidebar-details-genre'),
        document.getElementById('browse-sub-section-sidebar-details-country'),
        document.getElementById('browse-sub-section-sidebar-details-director'),
        document.getElementById('browse-sub-section-sidebar-details-cast'),
        document.getElementById('browse-sub-section-main-details-desc2')
    ];

    elementNode.forEach(element => {
        element.setAttribute('contenteditable', isInject);
    });

    if(isInject){
        document.getElementById('browse-sub-cover-details-rating').setAttribute('title', 'Valid Values: ' + 'U, P13, 18');
        document.getElementById('browse-sub-cover-details-score').setAttribute('title', 'Valid Values: ' + '0.0 - 10.0');
        document.getElementById('browse-sub-cover-details-title').setAttribute('title', 'Enter movie title here (ie. English title)');
        document.getElementById('browse-sub-cover-details-title2').setAttribute('title', 'Enter additional movie title here (ie. Japanese title or Chinese title)');
        document.getElementById('browse-sub-cover-details-desc').setAttribute('title', 'Enter short movie description here');
        document.getElementById('browse-sub-cover-details-score').addEventListener("input", function(){document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML = textTrim(document.getElementById('browse-sub-cover-details-score').innerHTML)});
        document.getElementById('browse-sub-section-sidebar-details-rating').addEventListener("input", function(){document.getElementById('browse-sub-cover-details-score').innerHTML = textTrim(document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML)});
        // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.add('disabled'); //disable edit rating in secondary compartment
        // document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.add('disabled'); //disable edit year in secondary compartment
    }else{
        elementNode.forEach(element => {
            element.removeAttribute('title');
        });
        // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.remove('disabled')
        // document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.remove('disabled');
    }
}

articleInsertButtonControl = function(state){
    var elementNode = document.getElementById('dashboard-content-sub-nav-childnode-edit');
    var elementNodeBack = document.getElementById('dashboard-content-sub-nav-childnode-back');
    // var elementNodeDelete = document.getElementById('dashboard-content-sub-nav-childnode-delete');

    elementNode.classList.remove('disabled');
    // elementNodeDelete.classList.add('hidden');
    elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleInsertControl('discard')",''));
    elementNode.setAttribute('onclick', "articleInsertControl(undefined)");
    contentSubAllowsEscape = true;

    if(state == 'edit'){
        // elementNode.classList.remove('disabled');
        elementNode.style.setProperty('color', 'crimson');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVE';
        elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleInsertControl('discard')",'') + ";articleInsertControl('discard')");
        document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.add('hidden');
    }else if(state == 'save'){
        elementNode.classList.add('disabled');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVING';
        contentSubAllowsEscape = false;
        // elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')",''));
    }else if(state == 'saved'){
        // elementNode.classList.remove('disabled');
        elementNode.style.setProperty('color', 'deepskyblue');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVED';
        var onclick = elementNode.getAttribute('onclick');
        elementNode.removeAttribute('onclick');
        setTimeout(function(){
            articleInsertButtonControl(null);
            elementNode.setAttribute('onclick', onclick);
        }, 2500)
        // contentSubAllowsEscape = true;
    }else{
        elementNode.style.setProperty('color', 'burlywood');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'EDIT';
        document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.remove('hidden');
    }
}

articleInsertCollector = function(){
    var iserror = [];
    // var isInsert = 0;
    // var articleArray = false;

    if(articleInsertState){
        // var articleArray2 = [...articleArray]; not applicable for 2D array
        var articleArray = {};
        articleArray['articleid'] = '';
        articleArray['visible'] = '1';
        articleArray['title'] = '';
        articleArray['title2'] = '';
        articleArray['description'] = '';
        articleArray['description2'] = '';
        articleArray['genre'] = {};
        articleArray['genre']['tags'] = [];
        articleArray['lang'] = {};
        articleArray['lang']['lang'] = [];
        articleArray['subtitle'] = {};
        articleArray['subtitle']['lang'] = [];
        articleArray['country'] = '';
        articleArray['rating'] = '';
        articleArray['score'] = '';
        articleArray['runtime'] = '';
        articleArray['director'] = '';
        articleArray['cast'] = {};
        articleArray['cast']['star'] = [];
        articleArray['reldate'] = '';
        articleArray['visual'] = {};
        articleArray['visual']['poster'] = '';
        articleArray['visual']['cover'] = '';
        articleArray['visual']['gallery'] = '';



        var localrating = document.getElementById('browse-sub-cover-details-rating').innerHTML;
        var localscore = document.getElementById('browse-sub-cover-details-score').innerHTML;
        var localtitle = document.getElementById('browse-sub-cover-details-title').innerHTML;
        var localtitle2 = document.getElementById('browse-sub-cover-details-title2').innerHTML;
        var localdescription = document.getElementById('browse-sub-cover-details-desc').innerHTML;
        var localyear = document.getElementById('browse-sub-section-sidebar-details-year').value;
        // var localrating2 = document.getElementById('browse-sub-section-sidebar-details-rating'); //score
        var locallang = document.getElementById('browse-sub-section-sidebar-details-lang').innerHTML;
        var localsubtitle = document.getElementById('browse-sub-section-sidebar-details-subtitle').innerHTML;
        var localduration = document.getElementById('browse-sub-section-sidebar-details-duration').innerHTML;
        var localgenre = document.getElementById('browse-sub-section-sidebar-details-genre').innerHTML;
        var localcountry = document.getElementById('browse-sub-section-sidebar-details-country').innerHTML;
        var localdirector =  document.getElementById('browse-sub-section-sidebar-details-director').innerHTML;
        var localcast = document.getElementById('browse-sub-section-sidebar-details-cast').innerHTML;
        var localdescription2 = document.getElementById('browse-sub-section-main-details-desc2').innerHTML;

        // rating
        if(localrating){
            if(textTrim(localrating).toUpperCase()){
                if(textTrim(localrating).toUpperCase() == 'P13' || textTrim(localrating).toUpperCase() == 'U' || textTrim(localrating).toUpperCase() == '18'){
                    articleArray['rating'] = textTrim(localrating).toUpperCase();
                }else{
                    iserror.push('film censorship rating');
                }
            }
        }else{
            iserror.push('film censorship rating');
        }

        // score
        if(parseFloat(textTrim(localscore)).toFixed(1)){
            if(parseFloat(textTrim(localscore)).toFixed(1) >= 0.0 && parseFloat(textTrim(localscore)).toFixed(1) <= 10.0){
                articleArray['score'] = parseFloat(textTrim(localscore)).toFixed(1);
            }else{
                iserror.push('rating');
            }
        }

        // title
        if(textTrim(localtitle)){
            if(textTrim(localtitle).length){
                articleArray['title'] = textTrim(localtitle);
            }else{
                iserror.push('title');
            }
        }

        // title2
        if(textTrim(localtitle2)){
            // if(textTrim(localtitle2).length){
                // allow empty
                articleArray['title2'] = textTrim(localtitle2);
            // }else{
            //     iserror.push('secondary title');
            // }
        }

        // desc
        if(textTrim(localdescription) != articleArray['description'] || textTrim(localdescription) != articleArray2['description']){
            // if(textTrim(localdescription).length){
                // allow empty
                articleArray['description'] = textTrim(localdescription);
            // }else{
            //     iserror.push('description');
            // }
        }

        // year
        if(localyear){
            articleArray['reldate'] = localyear;
        }else{
            iserror.push('date');
        }
        
        // lang
        if(locallang){
            if(textTrim(locallang).toUpperCase().replaceAll('--', '')){
                if(textTrim(locallang).length){
                    articleArray['lang']['lang'] = textTrim(locallang).toUpperCase().replaceAll('--', '').split(' ');
                    if(articleArray['lang']['lang'] == ''){
                        articleArray['lang']['lang'] = [];
                    }
                }else{
                    iserror.push('language');
                }
            }
        }else{
            iserror.push('language');
        }

        // sub
        if(localsubtitle){
            if(textTrim(localsubtitle).toUpperCase().replaceAll('--', '')){
                if(textTrim(localsubtitle).length){
                    articleArray['subtitle']['lang'] = textTrim(localsubtitle).toUpperCase().replaceAll('--', '').split(' ');
                    // console.log(articleArray['subtitle']['lang']);
                    if(articleArray['subtitle']['lang'] == ''){
                        articleArray['subtitle']['lang'] = [];
                    }
                    // console.log(articleArray['subtitle']['lang']);
                }else{
                    iserror.push('subtitle');
                }
                // console.log(articleArray['subtitle']['lang']);
            }
        }else{
            iserror.push('subtitle');
        }
        // console.log(articleArray['subtitle']['lang']);

        // duration
        if(parseInt(textTrim(localduration))){
            if(parseInt(textTrim(localduration)) >= 0){
                articleArray['runtime'] = parseInt(textTrim(localduration));
            }else{
                iserror.push('duration');
            }
        }

        // genre
        if(localgenre){
            if(textTrim(localgenre).toUpperCase().replaceAll('--', '')){
                if(textTrim(localgenre).length){
                    articleArray['genre']['tags'] = textTrim(localgenre).toUpperCase().replaceAll('--', '').split(' ');
                    if(articleArray['genre']['tags'] == ''){
                        articleArray['genre']['tags'] = [];
                    }
                }else{
                    iserror.push('genre');
                }
            }
        }else{
            iserror.push('genre');
        }

        // country
        if(localcountry){
            if(textTrim(localcountry).toUpperCase().replaceAll('--', '')){
                if(textTrim(localcountry).length){
                    articleArray['country'] = textTrim(localcountry).toUpperCase().replaceAll('--', '');
                }else{
                    iserror.push('country');
                }
            }
        }else{
            iserror.push('country');
        }

        // director (todo: allow empty)
        if(localdirector){
            if(textTrim(localdirector).toUpperCase().replaceAll('--', '')){
                if(textTrim(localdirector).length){
                    articleArray['director'] = textTrim(localdirector).toUpperCase().replaceAll('--', '');
                }else{
                    iserror.push('director');
                }
            }
        }else{
            iserror.push('director');
        }

        // cast (todo: allow empty)
        if(localcast){
            if(textTrim2(localcast).toUpperCase().replaceAll('--', '')){
                if(textTrim2(localcast).length){
                    articleArray['cast']['star'] = textTrim2(localcast).toUpperCase().replaceAll('--', '').split('<BR>');
                    if(articleArray['cast']['star'] == ''){
                        articleArray['cast']['star'] = [];
                    }
                }else{
                    iserror.push('cast');
                }
            }
        }else{
            iserror.push('cast');
        }

        // desc2
        if(textTrim(localdescription2)){
            if(textTrim(localdescription2).length){
                articleArray['description2'] = textTrim(localdescription2);
            }else{
                iserror.push('long description');
            }
        }

    }

    if(imageStore2 != null){
        articleArray['visual']['poster'] = imageStore2[0];
        articleArray['visual']['cover'] = imageStore2[1];
        articleArray['visual']['gallery'] = imageStore[2];
    }

    if(iserror.length){
        injectNoti("Invalid " + iserror.join(', ') + ". Ensure that details are entered correctly. ");
        return false;
    }else{
        return articleArray;
    }
}

// END arrticleCreate


// BEGIN articleEdit

var articleEditState = false;

articleEditControl = function(articleid, stage, stage2){
    if(articleid && user['accrisk'] == 1){
        articleid = articleid.toUpperCase();
        if(articleEditState === false){
            // enable edit
            articleEditInjector(true);
            articleEditState = true;
            injectNoti('<p>You are now in Edit Mode. Click on elements to edit details. </p>', null, 6000);
            articleEditButtonControl('edit');
        }else if(articleEditState === true && stage === undefined && stage2 === true){
            //upload file success, let's proceed to save
            articleEditServer(articleid, null, articleEditCollector(articleid)); //pass null for injection
        }else if(articleEditState === true && stage === undefined && stage2 === false){
            // upload file failed, proceed also but warn that file upload has problem
            articleEditServer(articleid, null, articleEditCollector(articleid)); //pass null for injection
            injectNoti('<p>An error occured while uploading images, therefore images will be excluded from updating movie details. </p>', null, 6000);
        }else if(articleEditState === true && articleid.toLowerCase() === 'discard'){
            // discard edit
            articleEditInjector(false);
            articleEditState = false;
            injectNoti('<p>Changes discarded. </p>', null, 5000);
            articleEditButtonControl();
        }else if(articleEditState === true && stage === undefined){
            // disable edit and save to server (inject)
            articleEditInjector(false);
            if(articleEditCollector(articleid) !== false){
                articleEditButtonControl('save');
                if(articleEditCollector(articleid) !== null){
                    if(imageStore!= null){
                        imageControl('risk-articleEdit', 'insert', imageStore, articleid);
                    }else{
                        articleEditServer(articleid, null, articleEditCollector(articleid)); //pass null for injection
                    }
                }else{
                    injectNoti("No changes detected. ");
                    articleEditState = false;
                    articleEditButtonControl();
                }
            }else{
                // invalid input detected, fallback to edit mode
                articleEditInjector(true);
                articleEditState = true;
                articleEditButtonControl('edit');
            }
        }else if(articleEditState === true && stage === true){
            // saved, everything looks good
            articleEditInjector(false);
            articleEditState = false;
            injectNoti('<p>Changes saved successfully. </p>', null, 5000);
            articleEditButtonControl('saved');
            contentControl('browse-sub', articleid);contentControl('browse-sub', articleid); // contentcontrol is also sub content toggle, thus trigger twice to remain on the sub content container (prevent dismiss)
        }else if(articleEditState === true && stage === false){
            // no, it does not look good. Fall back to edit mode
            articleEditInjector(true);
            articleEditState = true;
            injectNoti('<p>Failed to save changes. Consult administrator for more information. </p>', null, 6000);
            articleEditButtonControl('edit');
        }
    }
}

articleEditServer = function(articleid, state, articleArray){
    if(articleid && state === true){
        // server return success status
        articleEditControl(articleid, true);
    }else if(articleid && state === null && articleArray){
        // perform server inject
        articleServer('risk-articleEdit', 'update', JSON.stringify(articleArray), articleid);
    }else if(articleid && state === false){
        // server returned fail status
        articleEditControl(articleid, false);
    }
}

articleEditInjector = function(isInject){
    var elementNode = [
        document.getElementById('browse-sub-cover-details-rating'),
        document.getElementById('browse-sub-cover-details-score'),
        document.getElementById('browse-sub-cover-details-title'),
        document.getElementById('browse-sub-cover-details-title2'),
        document.getElementById('browse-sub-cover-details-desc'),
        // document.getElementById('browse-sub-section-sidebar-details-year'),
        document.getElementById('browse-sub-section-sidebar-details-rating'),
        document.getElementById('browse-sub-section-sidebar-details-lang'),
        document.getElementById('browse-sub-section-sidebar-details-subtitle'),
        document.getElementById('browse-sub-section-sidebar-details-duration'),
        document.getElementById('browse-sub-section-sidebar-details-genre'),
        document.getElementById('browse-sub-section-sidebar-details-country'),
        document.getElementById('browse-sub-section-sidebar-details-director'),
        document.getElementById('browse-sub-section-sidebar-details-cast'),
        document.getElementById('browse-sub-section-main-details-desc2')
    ];

    elementNode.forEach(element => {
        element.setAttribute('contenteditable', isInject);
    });

    if(isInject){
        document.getElementById('browse-sub-cover-details-rating').setAttribute('title', 'Valid Values: ' + 'U, P13, 18');
        document.getElementById('browse-sub-cover-details-score').setAttribute('title', 'Valid Values: ' + '0.0 - 10.0');
        document.getElementById('browse-sub-cover-details-title').setAttribute('title', 'Enter movie title here (ie. English title)');
        document.getElementById('browse-sub-cover-details-title2').setAttribute('title', 'Enter additional movie title here (ie. Japanese title or Chinese title)');
        document.getElementById('browse-sub-cover-details-desc').setAttribute('title', 'Enter short movie description here');
        document.getElementById('browse-sub-cover-details-score').addEventListener("input", function(){document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML = textTrim(document.getElementById('browse-sub-cover-details-score').innerHTML)});
        document.getElementById('browse-sub-section-sidebar-details-rating').addEventListener("input", function(){document.getElementById('browse-sub-cover-details-score').innerHTML = textTrim(document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML)});
        // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.add('disabled'); //disable edit rating in secondary compartment
        document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.add('disabled'); //disable edit year in secondary compartment
        document.getElementById('browse-sub-cover-imagePrompt').classList.remove('hidden');
    }else{
        elementNode.forEach(element => {
            element.removeAttribute('title');
        });
        // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.remove('disabled')
        document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.remove('disabled');
        document.getElementById('browse-sub-cover-imagePrompt').classList.add('hidden');
    }
}

articleEditButtonControl = function(state){
    var elementNode = document.getElementById('dashboard-content-sub-nav-childnode-edit');
    var elementNodeBack = document.getElementById('dashboard-content-sub-nav-childnode-back');
    var elementNodeDelete = document.getElementById('dashboard-content-sub-nav-childnode-delete');

    elementNode.classList.remove('disabled');
    elementNodeDelete.classList.remove('disabled');
    elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')",''));
    contentSubAllowsEscape = true;

    if(state == 'edit'){
        // elementNode.classList.remove('disabled');
        elementNode.style.setProperty('color', 'crimson');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVE';
        elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')",'') + ";articleEditControl('discard')");
    }else if(state == 'save'){
        elementNode.classList.add('disabled');
        elementNodeDelete.classList.add('disabled');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVING';
        contentSubAllowsEscape = false;
        // elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')",''));
    }else if(state == 'saved'){
        // elementNode.classList.remove('disabled');
        elementNode.style.setProperty('color', 'deepskyblue');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVED';
        var onclick = elementNode.getAttribute('onclick');
        elementNode.removeAttribute('onclick');
        setTimeout(function(){
            elementNode.style.setProperty('color', 'burlywood');
            elementNode.getElementsByTagName('span')[1].innerHTML = 'EDIT';
            elementNode.setAttribute('onclick', onclick);
        }, 2500)
        // contentSubAllowsEscape = true;
    }else{
        elementNode.style.setProperty('color', 'burlywood');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'EDIT';
    }
}

articleEditCollector = function(articleid){
    var iserror = [];
    var isEdit = 0;
    var articleArray = false;
    if(globalArticle){
        for(var i = 0; i < globalArticle.length; i++){
            if(globalArticle[i]['articleid'].toUpperCase() == articleid.toUpperCase()){
                articleArray = globalArticle[i];
                i = globalArticle.length;
            }else{
                articleArray = false;
            }
        };
    }

    if(articleEditState && articleArray !== false){
        // var articleArray2 = [...articleArray]; not applicable for 2D array
        var articleArray2 = {};
        articleArray2['articleid'] = articleArray['articleid'];
        articleArray2['visible'] = '1';
        articleArray2['title'] = articleArray['title'];
        articleArray2['title2'] = articleArray['title2'];
        articleArray2['description'] = articleArray['description'];
        articleArray2['description2'] = articleArray['description2'];
        articleArray2['genre'] = {};
        articleArray2['genre']['tags'] = {...articleArray['genre']['tags']};
        articleArray2['lang'] = {};
        articleArray2['lang']['lang'] = {...articleArray['lang']['lang']};
        articleArray2['subtitle'] = {};
        articleArray2['subtitle']['lang'] = {...articleArray['subtitle']['lang']};
        articleArray2['country'] = articleArray['country'];
        articleArray2['rating'] = articleArray['rating'];
        articleArray2['score'] = articleArray['score'];
        articleArray2['runtime'] = articleArray['runtime'];
        articleArray2['director'] = articleArray['director'];
        articleArray2['cast'] = {};
        articleArray2['cast']['star'] = {...articleArray['cast']['star']};
        articleArray2['reldate'] = articleArray['reldate'];
        articleArray2['visual'] = {};
        articleArray2['visual']['poster'] = articleArray['visual']['poster'];
        articleArray2['visual']['cover'] = articleArray['visual']['cover'];
        articleArray2['visual']['gallery'] = {...articleArray['visual']['gallery']};



        var localrating = document.getElementById('browse-sub-cover-details-rating').innerHTML;
        var localscore = document.getElementById('browse-sub-cover-details-score').innerHTML;
        var localtitle = document.getElementById('browse-sub-cover-details-title').innerHTML;
        var localtitle2 = document.getElementById('browse-sub-cover-details-title2').innerHTML;
        var localdescription = document.getElementById('browse-sub-cover-details-desc').innerHTML;
        // var localyear = document.getElementById('browse-sub-section-sidebar-details-year').innerHTML;
        // var localrating2 = document.getElementById('browse-sub-section-sidebar-details-rating'); //score
        var locallang = document.getElementById('browse-sub-section-sidebar-details-lang').innerHTML;
        var localsubtitle = document.getElementById('browse-sub-section-sidebar-details-subtitle').innerHTML;
        var localduration = document.getElementById('browse-sub-section-sidebar-details-duration').innerHTML;
        var localgenre = document.getElementById('browse-sub-section-sidebar-details-genre').innerHTML;
        var localcountry = document.getElementById('browse-sub-section-sidebar-details-country').innerHTML;
        var localdirector =  document.getElementById('browse-sub-section-sidebar-details-director').innerHTML;
        var localcast = document.getElementById('browse-sub-section-sidebar-details-cast').innerHTML;
        var localdescription2 = document.getElementById('browse-sub-section-main-details-desc2').innerHTML;

        // rating
        if(localrating){
            if(textTrim(localrating).toUpperCase() != articleArray['rating'].toUpperCase() || textTrim(localrating).toUpperCase() != articleArray2['rating'].toUpperCase()){
                if(textTrim(localrating).toUpperCase() == 'P13' || textTrim(localrating).toUpperCase() == 'U' || textTrim(localrating).toUpperCase() == '18'){
                    articleArray2['rating'] = textTrim(localrating).toUpperCase();
                    isEdit++;
                }else{
                    iserror.push('film censorship rating');
                }
            }
        }else{
            iserror.push('film censorship rating');
        }

        // score
        if(parseFloat(textTrim(localscore)).toFixed(1) != articleArray['score'] || parseFloat(textTrim(localscore)).toFixed(1) != articleArray2['score']){
            if(parseFloat(textTrim(localscore)).toFixed(1) >= 0.0 && parseFloat(textTrim(localscore)).toFixed(1) <= 10.0){
                articleArray2['score'] = parseFloat(textTrim(localscore)).toFixed(1);
                isEdit++;
            }else{
                iserror.push('rating');
            }
        }

        // title
        if(textTrim(localtitle) != articleArray['title'] || textTrim(localtitle) != articleArray2['title']){
            if(textTrim(localtitle).length){
                articleArray2['title'] = textTrim(localtitle);
                isEdit++;
            }else{
                iserror.push('title');
            }
        }

        // title2
        if(textTrim(localtitle2) != articleArray['title2'] || textTrim(localtitle2) != articleArray2['title2']){
            // if(textTrim(localtitle2).length){
                // allow empty
                articleArray2['title2'] = textTrim(localtitle2);
                isEdit++;
            // }else{
            //     iserror.push('secondary title');
            // }
        }

        // desc
        if(textTrim(localdescription) != articleArray['description'] || textTrim(localdescription) != articleArray2['description']){
            // if(textTrim(localdescription).length){
                // allow empty
                articleArray2['description'] = textTrim(localdescription);
                isEdit++;
            // }else{
            //     iserror.push('description');
            // }
        }

        // year
        // if(parseInt(textTrim(localyear)) != articleArray['year'] || parseInt(textTrim(localyear)) != articleArray2['year']){
        //     if(parseInt(textTrim(localyear)) > 1000){
        //         articleArray2['year'] = parseInt(textTrim(localyear));
        //     }else{
        //         iserror.push('year');
        //     }
        // }
        
        // lang
        if(locallang){
            if(textTrim(locallang).toUpperCase().replaceAll('--', '') != articleArray['lang']['lang'].toString().toUpperCase() || textTrim(localrating).replaceAll('--', '') != articleArray2['lang']['lang'].toString().toUpperCase()){
                if(textTrim(locallang).length){
                    articleArray2['lang']['lang'] = textTrim(locallang).toUpperCase().replaceAll('--', '').split(' ');
                    isEdit++;
                    if(articleArray2['lang']['lang'] == ''){
                        articleArray2['lang']['lang'].length = 0;
                    }
                }else{
                    iserror.push('language');
                }
            }
        }else{
            iserror.push('language');
        }

        // sub
        if(localsubtitle){
            if(textTrim(localsubtitle).toUpperCase().replaceAll('--', '') != articleArray['subtitle']['lang'].toString().toUpperCase() || textTrim(localsubtitle).replaceAll('--', '') != articleArray2['subtitle']['lang'].toString().toUpperCase()){
                if(textTrim(localsubtitle).length){
                    articleArray2['subtitle']['lang'] = textTrim(localsubtitle).toUpperCase().replaceAll('--', '').split(' ');
                    isEdit++;
                    if(articleArray2['subtitle']['lang'] == ''){
                        articleArray2['subtitle']['lang'].length = 0;
                    }
                }else{
                    iserror.push('subtitle');
                }
            }
        }else{
            iserror.push('subtitle');
        }

        // duration
        if(parseInt(textTrim(localduration)) != articleArray['runtime'] || parseInt(textTrim(localduration)) != articleArray2['runtime']){
            if(parseInt(textTrim(localduration)) >= 0){
                articleArray2['runtime'] = parseInt(textTrim(localduration));
                isEdit++;
            }else{
                iserror.push('duration');
            }
        }

        // genre
        if(localgenre){
            if(textTrim(localgenre).toUpperCase().replaceAll('--', '') != articleArray['genre']['tags'].toString().toUpperCase() || textTrim(localgenre).replaceAll('--', '') != articleArray2['genre']['tags'].toString().toUpperCase()){
                if(textTrim(localgenre).length){
                    articleArray2['genre']['tags'] = textTrim(localgenre).toUpperCase().replaceAll('--', '').split(' ');
                    isEdit++;
                    if(articleArray2['genre']['tags'] == ''){
                        articleArray2['genre']['tags'].length = 0;
                    }
                }else{
                    iserror.push('genre');
                }
            }
        }else{
            iserror.push('genre');
        }

        // country
        if(localcountry){
            if(textTrim(localcountry).toUpperCase().replaceAll('--', '') != articleArray['country'].toUpperCase() || textTrim(localcountry).toUpperCase().replaceAll('--', '') != articleArray2['country'].toUpperCase()){
                if(textTrim(localcountry).length){
                    articleArray2['country'] = textTrim(localcountry).toUpperCase().replaceAll('--', '');
                    isEdit++;
                }else{
                    iserror.push('country');
                }
            }
        }else{
            iserror.push('country');
        }

        // director (todo: allow empty)
        if(localdirector){
            if(textTrim(localdirector).toUpperCase().replaceAll('--', '') != articleArray['director'].toUpperCase() || textTrim(localdirector).toUpperCase().replaceAll('--', '') != articleArray2['director'].toUpperCase()){
                if(textTrim(localdirector).length){
                    articleArray2['director'] = textTrim(localdirector).toUpperCase().replaceAll('--', '');
                    isEdit++;
                }else{
                    iserror.push('director');
                }
            }
        }else{
            iserror.push('director');
        }

        // cast (todo: allow empty)
        if(localcast){
            if(textTrim2(localcast).toUpperCase().replaceAll('--', '') != articleArray['cast']['star'].toString().toUpperCase() || textTrim2(localcast).replaceAll('--', '') != articleArray2['cast']['star'].toString().toUpperCase()){
                if(textTrim2(localcast).length){
                    articleArray2['cast']['star'] = textTrim2(localcast).toUpperCase().replaceAll('--', '').split('<BR>');
                    isEdit++;
                    if(articleArray2['cast']['star'] == ''){
                        articleArray2['cast']['star'].length = 0;
                    }
                }else{
                    iserror.push('cast');
                }
            }
        }else{
            iserror.push('cast');
        }

        // desc2
        if(textTrim(localdescription2) != articleArray['description2'] || textTrim(localdescription2) != articleArray2['description2']){
            if(textTrim(localdescription2).length){
                articleArray2['description2'] = textTrim(localdescription2);
                isEdit++;
            }else{
                iserror.push('long description');
            }
        }


        
    }

    

    if(iserror.length){
        injectNoti("Invalid " + iserror.join(', ') + ". Ensure that details are entered correctly. ");
        return false;
    }else{
        if(imageStore2 != null){
            if(imageStore2[0] != null && imageStore2[0] != ''){
                articleArray2['visual']['poster'] = imageStore2[0];
            }
            if(imageStore2[1] != null && imageStore2[1] != ''){
                articleArray2['visual']['cover'] = imageStore2[1];
            }
            if(imageStore2[2] != null && imageStore2[2] != '' && imageStore2['visual']['gallery'] != []){
                articleArray2['visual']['gallery'] = imageStore2[2];
            }
        }
        
        if(isEdit && !(JSON.stringify(articleArray) == JSON.stringify(articleArray2))){
            // console.log(articleArray2);
            return articleArray2;
        }else{
            // injectNoti("No changes detected. ");
            return null;
        }
    }
}

// END articleEdit


// START articleDelete
var isDeletePrompt = false;

articleDeleteControl = function(articleid, state){
    // console.log(articleid, state);
    if(user['accrisk'] === true){
        var elementNode = document.getElementById('dashboard-content-sub-nav-childnode-delete');
        elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETE'
        if(elementNode.classList.contains('hidden')){
            // do nothing
        }else{
            elementNode.classList.remove('disabled');
            if(state === true && isDeletePrompt === false && articleid && articleid !== true){
                isDeletePrompt = true;
                elementNode.getElementsByTagName('span')[1].innerHTML = 'CONFIRM?';
            }else if(state === true && isDeletePrompt === true && articleid && articleid !== true){
                isDeletePrompt = false;
                elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETING';
                elementNode.classList.add('disabled');
                articleDeleteServer(null, articleid);
            }else if(state === true && articleid === true){
                if(articleEditState == true){
                    articleEditControl('discard');
                }
                contentControl(true, true);
                // console.log('wow');
                elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETE';
                injectNoti('<p>Movie deleted. </p>', null, 5000);
            }else if(state === false && articleid === false){
                elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETE';
                elementNode.classList.remove('disabled');
                injectNoti('<p>Failed to perform deletion. Consult administrator for more information. </p>', null, 6000);
            }
        }
    }
}

articleDeleteServer = function(state, articleid){
    if(state === true){
        // server return success status
        // console.log('test');
        articleDeleteControl(true, true);
    }else if(state === null && articleid){
        // perform server inject
        articleServer('risk-articleDelete', 'delete', articleid);
    }else if(state === false){
        // server returned fail status
        articleDeleteControl(false, false);
    }
}


articleDeleteButtonControl = function(state, articleid){

    
}


// END articleDelete

