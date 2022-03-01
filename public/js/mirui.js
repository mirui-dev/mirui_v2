/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/base.js":
/*!******************************!*\
  !*** ./resources/js/base.js ***!
  \******************************/
/***/ (() => {

var root = './';
var user = null;
var earlyInitVar = 0;

earlyInit = function (_earlyInit) {
  function earlyInit(_x) {
    return _earlyInit.apply(this, arguments);
  }

  earlyInit.toString = function () {
    return _earlyInit.toString();
  };

  return earlyInit;
}(function (check) {
  if (earlyInitVar < 3 && !check) {
    earlyInitVar++;
    earlyInit(true);
  } else if (earlyInitVar >= 3) {
    greetInject();
    document.getElementById('dashboard-nav-container').classList.remove('disabled');
  }
});

toggleLightUi = function toggleLightUi(isLightUi) {
  if (document.getElementsByTagName('body')[0].classList.contains('need-lightui') && !isLightUi) {
    document.getElementsByTagName('body')[0].classList.remove('need-lightui');
  } else if (!document.getElementsByTagName('body')[0].classList.contains('need-lightui') && isLightUi) {
    document.getElementsByTagName('body')[0].classList.add('need-lightui');
  }
};

textTrim = function textTrim(string) {
  if (string) {
    return string.replaceAll('<br>', ' ').replace(/&nbsp;+/g, ' ').replace(/\s+/g, ' ').trim();
  }

  return null;
};

textTrim2 = function textTrim2(string) {
  if (string) {
    return string.replace(/&nbsp;+/g, ' ').trim();
  }

  return null;
}; // reference: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random


intRand = function intRand(max) {
  return Math.floor(Math.random() * Math.floor(max));
};

/***/ }),

/***/ "./resources/js/components/article.js":
/*!********************************************!*\
  !*** ./resources/js/components/article.js ***!
  \********************************************/
/***/ (() => {

var globalArticle = null;
var globalArticle2 = null;

articleServer = function articleServer(page, mode, data, passingdata) {
  var fetchData = new URLSearchParams();

  if (page && page.includes('risk-') && mode && user['accrisk'] === true) {
    fetchData.append('risk', mode);
    fetchData.append('raw', data); // console.log(data);

    fetch(root + "core/article/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: fetchData
    }).then(function (Response) {
      return Response.json();
    }).then(function (var01) {
      if (var01.status == 'ok' && var01.raw) {
        //operation succeded
        // expected to have a list of complete latest articles, so direct update list
        // note: we assume that editing is only allowed in 'browse' page
        globalArticle = var01.raw;

        if (page === 'risk-articleEdit' && contentPage == 'browse') {
          // refresh browse list (direct inject, assuming edit is only allowed in browse)
          articleControl(true); // perform search since we already reinject the articles

          articleSearch(); // refresh the sub content section since we are editing
          // contentControl('browse-sub', )
          // callback

          articleEditServer(passingdata, true);
        } else if (page === 'risk-articleInsert' && contentPage == 'browse') {
          articleControl(true); // clear the search

          document.getElementById('browse-search-input').value = '';
          articleSearch(); // callback

          articleInsertServer(true);
        } else if (page === 'risk-articleDelete' && contentPage == 'browse') {
          articleControl(true);
          articleSearch();
          articleDeleteServer(true);
        }
      } else {
        // this does not look good
        if (page === 'risk-articleEdit' && contentPage == 'browse') {
          // callback
          articleEditServer(passingdata, false);
        } else if (page === 'risk-articleInsert' && contentPage == 'browse') {
          // callback
          articleInsertServer(passingdata, false);
        } else if (page === 'risk-articleDelete' && contentPage == 'browse') {
          // callback
          articleDeleteServer(false);
        }
      }
    })["catch"](function (var01) {
      // console.log(var01);
      // callback
      // articleEditServer(passingdata, false);
      if (page === 'risk-articleEdit' && contentPage == 'browse') {
        // callback
        articleEditServer(passingdata, false);
      } else if (page === 'risk-articleInsert' && contentPage == 'browse') {
        // callback
        articleInsertServer(passingdata, false);
      } else if (page === 'risk-articleDelete' && contentPage == 'browse') {
        // callback
        articleDeleteServer(false);
      }
    });
  } else {
    fetch(root + "core/article/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      }
    }).then(function (Response) {
      return Response.json();
    }).then(function (var01) {
      if (var01.status == 'ok') {
        //update global article
        globalArticle = var01.raw;

        if (page == 'dashboard') {
          // cartControl('maintenance');
          if (mode) {
            articleControl(true, mode);
          } else {
            articleControl(true);
          }
        } else if (page == 'root') {
          // for home page
          rootArticleControl(false);
        }
      } else {
        // append no image icon
        if (page == 'root') {
          // for home page
          rootArticleControl(false);
        }
      }
    })["catch"](function (var01) {// console.log(var01);
    });
  }
};

/***/ }),

/***/ "./resources/js/components/asset.js":
/*!******************************************!*\
  !*** ./resources/js/components/asset.js ***!
  \******************************************/
/***/ (() => {

imageControl = function imageControl(args01, mode, args02, passingdata) {
  if (user && user['accrisk'] === true && args01 !== undefined && mode != null && args02 != null) {
    if (args01 && args01.includes('risk-') && args02 && mode) {
      var fetchData = new URLSearchParams();
      fetchData.append('risk', mode);
      fetchData.append("raw", JSON.stringify(args02));
      fetch(root + "core/asset/", {
        method: 'post',
        headers: {
          "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: fetchData
      }).then(function (Response) {
        return Response.json();
      }).then(function (var01) {
        if (var01.status == 'ok' && var01.visual) {
          imageStore2 = var01.visual; // console.log(var01.visual);

          if (args01 == 'risk-articleInsert') {
            articleInsertControl(undefined, true);
          } else if (args01 == 'risk-articleEdit') {
            articleEditControl(passingdata, undefined, true);
          }
        } else {
          imageStore = null;
          imageStore2 = null;

          if (args01 == 'risk-articleInsert') {
            articleInsertControl(undefined, false);
          } else if (args01 == 'risk-articleEdit') {
            articleEditControl(passingdata, undefined, false);
          }
        }
      })["catch"](function (var01) {
        // append no image icon
        console.log(var01);
        imageStore = null;
        imageStore2 = null;

        if (args01 == 'risk-articleInsert') {
          articleInsertControl(undefined, false);
        } else if (args01 == 'risk-articleEdit') {
          articleEditControl(passingdata, undefined, false);
        }
      });
    }
  } else if (args01) {
    args01 = args01.toLowerCase();
    var fetchData = new URLSearchParams();
    fetchData.append("asset", 0);
    fetchData.append("assetid", args01);
    fetch(root + "core/asset/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: fetchData
    }).then(function (Response) {
      return Response.json();
    }).then(function (var01) {
      if (var01.status == 'ok' && var01.raw) {
        if (var01.raw != null) {
          var imgData = var01.raw; //btoa()
          // console.log(var01.raw);

          var imgURL = 'data:image/jpeg;base64, ' + imgData;
          fetch(imgURL).then(function (Response) {
            return Response.blob();
          }).then(function (Response) {
            imgURL = URL.createObjectURL(Response);
            var element = document.getElementsByClassName('core-imageControl-' + args01); // console.log(args01);
            // document.documentElement.style.setProperty('--core-imageControl-' + args01, "url('" + imgURL + "')");

            for (var i = 0; i < element.length; i++) {
              element[i].style.setProperty('--core-imageControl-' + args01, "url('" + imgURL + "')");

              if (element[i].tagName == 'IMG') {
                element[i].setAttribute('src', imgURL);
              }
            }
          });
        } else {//append no image icon
        }
      } else {// append no image icon
      }
    })["catch"](function (var01) {
      // append no image icon
      console.log(var01);
    });
  }
};

/***/ }),

/***/ "./resources/js/components/cart.js":
/*!*****************************************!*\
  !*** ./resources/js/components/cart.js ***!
  \*****************************************/
/***/ (() => {

var userCart = {
  "item": []
};

cartServer = function (_cartServer) {
  function cartServer(_x) {
    return _cartServer.apply(this, arguments);
  }

  cartServer.toString = function () {
    return _cartServer.toString();
  };

  return cartServer;
}(function (articleid) {
  if (articleid) {
    var fetchData = new URLSearchParams();
    fetchData.append("cart", articleid);
    fetch(root + "core/cart/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: fetchData
    }) //already json, no need var01.json() anymore
    .then(function (var01) {
      if (var01.status != 'ok') {
        cartServer();
      }
    })["catch"](function (var01) {
      // dno nothing
      console.log(var01);
    });
  } else {
    var fetchData = new URLSearchParams();
    fetch(root + "core/cart/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      }
    }).then(function (var01) {
      return var01.json();
    }).then(function (var01) {
      if (var01.cart) {
        userCart = var01.cart;
        cartCounter();

        if (contentPage && contentSel == 'cart') {
          // only update article when contentpage is active and is cart page
          articleControl(false, 'cart');
        }
      }

      if (!contentSel) {
        earlyInit(); //onload(1)
      }
    })["catch"](function (var01) {
      // dno nothing
      console.log(var01);
    });
  }
});

/***/ }),

/***/ "./resources/js/components/library.js":
/*!********************************************!*\
  !*** ./resources/js/components/library.js ***!
  \********************************************/
/***/ (() => {

var userLibrary = {
  "library": []
};

libraryServer = function libraryServer() {
  var fetchData = new URLSearchParams();
  fetch(root + "core/library/", {
    method: 'post',
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
  }).then(function (var01) {
    return var01.json();
  }).then(function (var01) {
    if (var01.library) {
      userLibrary['library'] = var01.library;

      if (contentPage && contentSel == 'library') {
        articleControl(false, 'library');
      }
    }

    if (!contentSel) {
      earlyInit(); //onload(2)
    }
  })["catch"](function (var01) {
    // dno nothing
    console.log(var01);
  });
};

/***/ }),

/***/ "./resources/js/components/noti.js":
/*!*****************************************!*\
  !*** ./resources/js/components/noti.js ***!
  \*****************************************/
/***/ (() => {

var notiNum = 0;

injectNoti = function injectNoti(args01, args02, args03) {
  if (args01 && args01.length) {
    if (args03) {
      var delay = args03;
    } else {
      var delay = 5000;
    }

    var notiElement = document.createElement('div');
    var notiId = "global-noti-element-" + notiNum;
    notiElement.setAttribute('id', notiId);
    notiElement.setAttribute('class', 'global-noti');
    notiElement.setAttribute('onclick', "document.getElementById('" + notiId + "').parentNode.removeChild(document.getElementById('" + notiId + "'));" + "if(!document.getElementsByClassName('global-noti').length){document.getElementById('global-noti-parent').style.display = 'none';}");
    notiElement.innerHTML = args01;
    document.getElementById('global-noti-parent').insertAdjacentHTML('afterbegin', notiElement.outerHTML);
    document.getElementById('global-noti-parent').style.display = 'flex';

    if (args02 && args02.length) {
      document.getElementById(notiId).style.borderBottomColor = args02;
    }

    if (args03 != 0) {
      setTimeout(function () {
        if (document.getElementById(notiId)) {
          document.getElementById(notiId).style.animation = ".5s notidismiss";
          document.getElementById(notiId).style.opacity = 0;
          setTimeout(function () {
            if (document.getElementById(notiId)) {
              document.getElementById(notiId).parentNode.removeChild(document.getElementById(notiId));

              if (!document.getElementsByClassName('global-noti').length) {
                document.getElementById('global-noti-parent').style.display = 'none';
              }
            }
          }, 400);
        }
      }, delay);
    }

    notiNum++;
  }
};

/***/ }),

/***/ "./resources/js/components/transaction.js":
/*!************************************************!*\
  !*** ./resources/js/components/transaction.js ***!
  \************************************************/
/***/ (() => {

transactionServer = function transactionServer(isPayment) {
  contentSubAllowsEscape = false;
  var fetchData = new URLSearchParams();

  if (isPayment) {
    // for payment use
    fetchData.append('query', null);
    fetchData.append('coin', parseInt(isPayment));
    fetch(root + "auth/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: fetchData
    }).then(function (var01) {
      return var01.json();
    }).then(function (var01) {
      contentSubAllowsEscape = true;

      if (var01.status == 'ok') {
        userServer(true);
        transactionControl('complete', false, true);
      }
    })["catch"](function (var01) {
      // dno nothing
      console.log(var01);
    });
  } else {
    // for checkout use
    fetchData.append('cart', cartControl());
    fetch(root + "core/library/", {
      method: 'post',
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body: fetchData
    }).then(function (var01) {
      return var01.json();
    }).then(function (var01) {
      contentSubAllowsEscape = true;

      if (var01.status == 'ok') {
        userServer(true);
        cartServer();
        libraryServer();
        transactionControl('complete', false, true);
      }
    })["catch"](function (var01) {
      // dno nothing
      console.log(var01);
    });
  }
};

/***/ }),

/***/ "./resources/js/components/user.js":
/*!*****************************************!*\
  !*** ./resources/js/components/user.js ***!
  \*****************************************/
/***/ (() => {

var user = [];
var userAvatar = null;

userServer = function userServer(query) {
  var fetchData = new URLSearchParams();
  fetchData.append('query', query);
  fetch(root + "auth/", {
    method: 'post',
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    },
    body: fetchData
  }).then(function (Response) {
    return Response.json();
  }).then(function (var01) {
    if (var01.status == 'ok') {
      if (query === true && var01.user) {
        user = var01.user;
        earlyInit(); //onload

        if (contentPage == 'profile') {
          userControl(true, query);
        }
      } else if (query == 'avatar') {
        if (var01.avatar != null) {
          var imgData = var01.avatar; //btoa()

          var imgURL = 'data:image/jpeg;base64, ' + imgData; // console.log(imgURL);

          fetch(imgURL).then(function (Response) {
            return Response.blob();
          }).then(function (Response) {
            imgURL = URL.createObjectURL(Response);
            userAvatar = imgURL;

            if (contentPage == 'profile') {
              userControl(true, query);
            }
          });
        } else {
          userAvatar = null;

          if (contentPage == 'profile') {
            userControl(true, query);
          }
        }
      }
    } else {
      // append no image icon
      if (contentPage == 'profile') {
        userControl(false, false);
      }
    }
  })["catch"](function (var01) {// console.log(var01);
  });
};

userAvatarServer = function userAvatarServer(img64) {
  var fetchData = new URLSearchParams();
  fetchData.append('raw', img64);
  fetchData.append('query', null); //magickk
  // console.log(img64);

  fetch(root + "auth/", {
    method: 'post',
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    },
    body: fetchData
  }).then(function (Response) {
    return Response.json();
  }).then(function (var01) {
    if (var01.status == 'ok') {
      //callback
      userAvatarControl(true);
    } else {
      // callback
      userAvatarControl(false);
    }
  })["catch"](function (var01) {// console.log(var01);
  });
};

/***/ }),

/***/ "./resources/js/nav.js":
/*!*****************************!*\
  !*** ./resources/js/nav.js ***!
  \*****************************/
/***/ (() => {

var isNav = 0;

global_nav_toggleNav = function global_nav_toggleNav() {
  if (isNav) {
    setTimeout(function () {
      document.getElementById('global-nav').style.display = "none";
    }, 400);
    document.getElementById('global-nav').style.opacity = 0;
    isNav = 0;
  } else {
    document.getElementById('global-nav').style.display = "flex";
    document.getElementById('global-nav').style.opacity = 1;
    isNav = 1;
  }
};

/***/ }),

/***/ "./resources/js/views/mirui-dashboard-article.js":
/*!*******************************************************!*\
  !*** ./resources/js/views/mirui-dashboard-article.js ***!
  \*******************************************************/
/***/ (() => {

articleControl = function articleControl(isInject, mode) {
  globalArticle2 = null;

  if (!isInject) {
    // fetch first so not injecting yet
    if (mode) {
      articleServer('dashboard', mode);
    } else {
      articleServer('dashboard');
    }
  } else if (isInject && mode) {
    globalArticle2 = articleFilter(mode);
    articleInject(globalArticle2);
  } else if (isInject) {
    // update cart to delete non-existence item
    cartControl('maintenance'); // var globalArticle2 = articleFilter();

    globalArticle2 = null;
    articleInject(articleFilter());
  }
};

articleInject = function articleInject(articleid, isSub) {
  if (articleid && isSub) {
    //articleid is not array
    articleid = articleid.toLowerCase();

    for (var i = 0; i < globalArticle.length; i++) {
      if (globalArticle[i]['articleid'].toLowerCase() == articleid) {
        // control nav cart button
        cartButtonControl(articleid);
        document.getElementById('dashboard-content-sub-nav-childnode-cart').setAttribute('onclick', "cartControl('" + articleid + "')"); // control tide button

        document.getElementById('dashboard-content-sub-nav-childnode-edit').setAttribute('onclick', "articleEditControl('" + articleid + "')");
        articleEditState = false; // control eteled button

        document.getElementById('dashboard-content-sub-nav-childnode-delete').setAttribute('onclick', "articleDeleteControl('" + articleid + "', true)");
        articleDeletePrompt = false; // control watch button

        document.getElementById('dashboard-content-sub-nav-childnode-watch').setAttribute('onclick', "window.open('" + root + "watch?v=" + articleid + "')");
        var currentElement = document.getElementById('browse-sub-cover');

        if (globalArticle[i]['rating'].length) {
          document.getElementById('browse-sub-cover-details-rating').innerHTML = globalArticle[i]['rating'];
        }

        document.getElementById('browse-sub-cover-details-score').innerHTML = parseFloat(globalArticle[i]['score']).toFixed(1);

        if (globalArticle[i]['title'].length) {
          document.getElementById('browse-sub-cover-details-title').innerHTML = globalArticle[i]['title'];
        }

        if (globalArticle[i]['title2'].length) {
          document.getElementById('browse-sub-cover-details-title2').innerHTML = globalArticle[i]['title2'];
        }

        if (globalArticle[i]['description'].length) {
          document.getElementById('browse-sub-cover-details-desc').innerHTML = globalArticle[i]['description'];
        }

        if (globalArticle[i]['description2'].length) {
          document.getElementById('browse-sub-section-main-details-desc2').innerHTML = globalArticle[i]['description2'];
        }

        var articleDate = new Date(globalArticle[i]['reldate']);
        document.getElementById('browse-sub-section-sidebar-details-year').innerHTML = articleDate.getFullYear();
        document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML = parseFloat(globalArticle[i]['score']).toFixed(1);

        if (globalArticle[i]['lang']) {
          if (globalArticle[i]['lang']['lang'] && globalArticle[i]['lang']['lang'].length) {
            document.getElementById('browse-sub-section-sidebar-details-lang').innerHTML = globalArticle[i]['lang']['lang'].join(' ');
          }
        }

        if (globalArticle[i]['subtitle']) {
          if (globalArticle[i]['subtitle']['lang'] && globalArticle[i]['subtitle']['lang'].length) {
            document.getElementById('browse-sub-section-sidebar-details-subtitle').innerHTML = globalArticle[i]['subtitle']['lang'].join(' ');
          }
        }

        document.getElementById('browse-sub-section-sidebar-details-duration').innerHTML = globalArticle[i]['runtime'] + 'm';

        if (globalArticle[i]['genre']) {
          if (globalArticle[i]['genre']['tags'] && globalArticle[i]['genre']['tags'].length) {
            document.getElementById('browse-sub-section-sidebar-details-genre').innerHTML = globalArticle[i]['genre']['tags'].join(' ');
          }
        }

        if (globalArticle[i]['country'].length) {
          document.getElementById('browse-sub-section-sidebar-details-country').innerHTML = globalArticle[i]['country'];
        }

        if (globalArticle[i]['director'].length) {
          document.getElementById('browse-sub-section-sidebar-details-director').innerHTML = globalArticle[i]['director'];
        }

        if (globalArticle[i]['cast']) {
          if (globalArticle[i]['cast']['star'] && globalArticle[i]['cast']['star'].length) {
            document.getElementById('browse-sub-section-sidebar-details-cast').innerHTML = globalArticle[i]['cast']['star'].join('<br>');
          }
        }

        if (globalArticle[i]['visual']) {
          if (globalArticle[i]['visual']['cover']) {
            currentElement.classList.add('core-imageControl-' + globalArticle[i]['visual']['cover'].toLowerCase());
            currentElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), var(--core-imageControl-' + globalArticle[i]['visual']['cover'].toLowerCase() + ')');
            imageControl(globalArticle[i]['visual']['cover'].toLowerCase());
          }
        }

        i = globalArticle.length;
      }
    }
  } else if (articleid) {
    //articleid is array
    // if(globalArticle2){
    //     articleid = globalArticle2;
    // }
    if (document.getElementById('browse-gallery').childNodes.length) {
      //prevent duplication
      document.getElementById('browse-gallery').innerHTML = '';
    }

    for (var i = 0; i < articleid.length; i++) {
      // if(articleid[i]['visible'] == 1){
      articleNode(i, articleid[i]['articleid'].toLowerCase());

      if (articleid[i]['visible'] == 1 || user['accrisk'] === true) {
        var currentElement = document.getElementById('browse-gallery-node-' + i);
        currentElement.getElementsByClassName('browse-gallery-node-score')[0].innerHTML = parseFloat(articleid[i]['score']).toFixed(1);
        currentElement.getElementsByClassName('browse-gallery-node-details-title')[0].innerHTML = articleid[i]['title'];

        if (JSON.stringify(articleid[i]['visual']) != '{}') {
          if (articleid[i]['visual']['poster']) {
            currentElement.classList.add('core-imageControl-' + articleid[i]['visual']['poster'].toLowerCase());
            currentElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), var(--core-imageControl-' + articleid[i]['visual']['poster'].toLowerCase() + ')');
            imageControl(articleid[i]['visual']['poster'].toLowerCase());
          }
        }

        if (articleid[i]['visible'] != 1) {
          currentElement.classList.add('disabled');
        }
      } // }

    }
  }
};

articleNode = function articleNode(articleCount, articleid) {
  if (articleCount != null) {
    var browseGallery = document.getElementById('browse-gallery');
    var nodeArray = [];
    var articleArray = globalArticle;

    if (globalArticle2) {
      articleArray = globalArticle2;
    }

    if (articleArray[articleCount]['visible'] == 1 || user['accrisk'] === true) {
      nodeArray.push('<div id="browse-gallery-node-' + articleCount + '" class="browse-gallery-node flex" onclick="contentControl(' + "'browse-sub', '" + articleid + "'" + ')">');
      nodeArray.push('<span class="browse-gallery-node-score content-width"></span>');
      nodeArray.push('<div class="browse-gallery-node-details flex max-height fill-width">');
      nodeArray.push('<h1 class="browse-gallery-node-details-title">');
      nodeArray.push('</h1>');
      nodeArray.push('</div>');
    } else {
      nodeArray.push('<div id="browse-gallery-node-' + articleCount + '">');
    }

    nodeArray.push('</div>');
    browseGallery.insertAdjacentHTML('beforeend', nodeArray.join(''));
  }
};

articleFilter = function articleFilter(mode) {
  var ret = [];

  if (mode == 'library') {
    for (var i = 0; i < globalArticle.length; i++) {
      userLibrary['library'].forEach(function (count) {
        if (count['articleid'].toUpperCase() == globalArticle[i]['articleid'].toUpperCase()) {
          ret.push(globalArticle[i]);
        }
      });
    }
  } else if (mode == 'cart') {
    for (var i = 0; i < globalArticle.length; i++) {
      if (cartControl().toString().toUpperCase().search(globalArticle[i]['articleid'].toUpperCase()) != -1) {
        ret.push(globalArticle[i]);
      }
    }

    if (contentPage && contentSel == 'cart') {
      cartCounter();
    }
  } else {
    ret = globalArticle;
  }

  return ret;
};

articleSearch = function articleSearch() {
  try {
    var sterm = document.getElementById('browse-search-input').value.toLowerCase().split(' ');
    var localArticle = globalArticle;

    if (globalArticle2) {
      localArticle = globalArticle2;
    }

    var childmatch = false;

    if (sterm.length) {
      // perform all search
      for (var i = 0; i < localArticle.length; i++) {
        for (var j = 0; j < sterm.length; j++) {
          var tmpterm = sterm[j].trim(); // console.log(tmpterm);

          var articleDate = new Date(localArticle[i]['reldate']);
          var articleGenre = '';
          var articleCast = '';

          if (localArticle[i]['genre']) {
            if (localArticle[i]['genre']['tags'] && localArticle[i]['genre']['tags'].length) {
              articleGenre = localArticle[i]['genre']['tags'].toString().toLowerCase();
            }
          }

          if (localArticle[i]['cast']) {
            if (localArticle[i]['cast']['star'] && localArticle[i]['cast']['star'].length) {
              articleCast = localArticle[i]['cast']['star'].toString().toLowerCase();
            }
          }

          if (localArticle[i]['title'].toLowerCase().search(tmpterm) != -1 || localArticle[i]['title2'].toLowerCase().search(tmpterm) != -1 // || (globalArticle[i]['genre']['tags'].toString().toLowerCase().search(tmpterm) != -1)
          || articleGenre.search(tmpterm) != -1 || localArticle[i]['country'].toLowerCase().search(tmpterm) != -1 || localArticle[i]['score'][0] == tmpterm.replace('.', '') && tmpterm.length <= 2 || localArticle[i]['score'] == tmpterm || (localArticle[i]['score'].length == 1 || localArticle[i]['score'].length == 2) && localArticle[i]['score'] + '.0' == tmpterm || localArticle[i]['director'].toLowerCase().search(tmpterm) != -1 // || globalArticle[i]['cast']['star'].toString().toLowerCase().search(tmpterm) != -1
          || articleCast.search(tmpterm) != -1 || articleDate.getFullYear().toString().search(tmpterm) != -1 // special: match 'anime' with animation genre
          || tmpterm == 'anime' && articleGenre.search('animation') != -1) {
            if (j == 0 && !childmatch) {
              childmatch = true;
            } else if (!childmatch) {
              childmatch = false;
            }
          } else {
            childmatch = false;
          }
        }

        if (!childmatch) {
          document.getElementById('browse-gallery-node-' + i).style.setProperty('display', 'none');
        } else {
          document.getElementById('browse-gallery-node-' + i).style.removeProperty('display');
        }
      }
    }
  } catch (e) {// console.log(e);
  }
};

/***/ }),

/***/ "./resources/js/views/mirui-dashboard-cart.js":
/*!****************************************************!*\
  !*** ./resources/js/views/mirui-dashboard-cart.js ***!
  \****************************************************/
/***/ (() => {

cartControl = function (_cartControl) {
  function cartControl(_x, _x2) {
    return _cartControl.apply(this, arguments);
  }

  cartControl.toString = function () {
    return _cartControl.toString();
  };

  return cartControl;
}(function (articleid, isDel) {
  if (articleid && articleid.toLowerCase() == 'maintenance') {
    // console.log('test');
    for (var i = 0; i < userCart['item'].length; i++) {
      var isexist = 0;
      globalArticle.filter(function (article) {
        if (article.articleid.toUpperCase() == userCart['item'][i].toUpperCase()) {
          if (parseInt(article.visible)) {
            isexist++;
          }
        }
      });

      if (!isexist) {
        // this movie no longer exists
        cartControl(userCart['item'][i], true);
      }
    }
  } else if (articleid) {
    articleid = articleid.toUpperCase();

    if (isDel) {
      if (userCart['item'].includes(articleid)) {
        userCart['item'].splice(userCart['item'].indexOf(articleid), 1);
        cartServer(JSON.stringify(userCart));
      }
    } else {
      // if(articleid.toLowerCase() == 'maintenance'){
      //     // console.log('test');
      //     for(var i = 0; i < userCart['item'].length; i++){
      //         var isexist = 0;
      //         globalArticle.filter(function(article){
      //             if(article.articleid.toUpperCase() == userCart['item'][i].toUpperCase()){
      //                 if(parseInt(article.visible)){
      //                     isexist++;
      //                 }
      //             }
      //         });
      //         if(!isexist){
      //             // this movie no longer exists
      //             cartControl(userCart['item'][i], true);
      //         }
      //     }
      // }else{
      if (userCart['item'].includes(articleid)) {
        // delete from cart
        // injectNoti('Item has already been added to cart!', 'orange');
        cartControl(articleid, true);
      } else {
        // update article list
        articleServer(); // perform a search whether articleid is valid

        for (var i = 0; i < globalArticle.length; i++) {
          if (globalArticle[i]['articleid'] == articleid && !libraryControl(articleid)) {
            // add to cart
            userCart['item'].push(articleid);
            cartServer(JSON.stringify(userCart));
            i = globalArticle.length;
          }
        }
      } // }

    }

    if (contentPage && contentSel == 'cart') {
      // only update article when contentpage is active and is cart page
      articleControl(false, contentPage);
    }

    if (contentPage && document.getElementById('dashboard-content-sub-nav').classList.contains('active')) {
      // control nav cart button when contentpage is active
      cartButtonControl(articleid);
    }
  } else if (articleid == 0) {
    // empty cart
    userCart['item'] = [];
    cartServer(JSON.stringify(userCart));
  } else {
    return userCart['item'];
  }
});

cartCounter = function cartCounter() {
  var element = document.getElementsByClassName('dashboard--cart-number');
  var count = userCart['item'].length;

  for (var i = 0; i < element.length; i++) {
    element[i].innerHTML = count;
  }

  if (!count) {
    document.getElementById('dashboard-nav-menu-cart-number').classList.remove('active');

    if (contentPage && contentSel == 'cart') {
      document.getElementById('browse-action-checkout').classList.add('disabled');
    }
  } else {
    document.getElementById('dashboard-nav-menu-cart-number').classList.add('active');

    if (contentPage && contentSel == 'cart') {
      document.getElementById('browse-action-checkout').classList.remove('disabled');
    }
  }

  return count;
};

cartButtonControl = function cartButtonControl(status) {
  var mainElement = document.getElementById('dashboard-content-sub-nav-childnode-cart');

  if (status == undefined) {
    if (mainElement.getElementsByTagName('span')[0].classList.contains('lnr-checkmark-circle')) {
      status = false; //to remove
    } else {
      status = true; // to add
    }
  }

  if (status && status != true) {
    status = status.toUpperCase();

    for (var i = 0; i < cartControl().length; i++) {
      if (cartControl()[i].toUpperCase() == status) {
        status = true;
        i = cartControl().length;
      }
    }

    for (var i = 0; i < libraryControl().length; i++) {
      if (status != 'true' && libraryControl()[i]['articleid'].toUpperCase() == status) {
        status = 'library';
        i = libraryControl().length;
      }
    } // console.log(status);


    if (status !== true && status != 'library') {
      status = false;
    }
  } // console.log(status);


  mainElement.getElementsByTagName('span')[0].classList.remove('lnr-cart');
  mainElement.getElementsByTagName('span')[0].classList.remove('lnr-checkmark-circle');
  mainElement.getElementsByTagName('span')[0].classList.remove('lnr-cloud-check');
  document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.add('hidden');

  if (status == 'library') {
    mainElement.getElementsByTagName('span')[0].classList.add('lnr-cloud-check');
    mainElement.getElementsByTagName('span')[1].innerHTML = 'ADDED';
    mainElement.removeAttribute('onclick');
    document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.remove('hidden');
  } else if (status) {
    // added to cart
    mainElement.getElementsByTagName('span')[0].classList.add('lnr-checkmark-circle');
    mainElement.getElementsByTagName('span')[1].innerHTML = 'UNADD';
  } else if (!status) {
    // removed from cart
    mainElement.getElementsByTagName('span')[0].classList.add('lnr-cart');
    mainElement.getElementsByTagName('span')[1].innerHTML = 'ADD';
  }
};

/***/ }),

/***/ "./resources/js/views/mirui-dashboard-library.js":
/*!*******************************************************!*\
  !*** ./resources/js/views/mirui-dashboard-library.js ***!
  \*******************************************************/
/***/ (() => {

libraryControl = function libraryControl(articleid) {
  var ret = false;
  var tmpArray = [];

  if (userLibrary['library'].length) {
    ret = [];
    userLibrary['library'].forEach(function (count) {
      tmpArray.push(count);
    });
    ret = tmpArray;
  }

  if (articleid) {
    articleid = articleid.toUpperCase();

    for (var i = 0; i < tmpArray.length; i++) {
      if (tmpArray[i]['articleid'].toUpperCase() == articleid) {
        ret = true;
        i = tmpArray.length;
      }
    }

    if (ret != true) {
      ret = false;
    }
  }

  return ret;
};

/***/ }),

/***/ "./resources/js/views/mirui-dashboard-risk.js":
/*!****************************************************!*\
  !*** ./resources/js/views/mirui-dashboard-risk.js ***!
  \****************************************************/
/***/ (() => {

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// BEGIN articleImage
var imageStore = null;
var imageStore2 = null;

articleImageControl = function articleImageControl(type, isMultisel) {
  if (type && (type == 'poster' || type == 'cover') && isMultisel == undefined) {
    var imageSwitch = document.getElementById('browse-sub-cover-imagePrompt-' + type); // imgtest = imageSwitch;

    if (imageSwitch.files && imageSwitch.files.length) {
      // var imageSel = imageSwitch.files[0]['type'];
      // check file type
      if (imageSwitch.files[0]['type'].indexOf('image/') === 0) {
        // it is an image, OK
        // check file size
        if (imageSwitch.files[0]['size'] < 16777216) {
          // file size below 16MB, OK
          //prepare file reader
          var imageReaderRAW = new FileReader(); // for preview just use object URL, cannot use base64 because too long

          var imageStoreObject = URL.createObjectURL(imageSwitch.files[0]);

          if (type == 'cover') {
            coverElement = document.getElementById('browse-sub-cover');
            coverElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), url(' + imageStoreObject + ')');
          } // this is for the RAW one


          imageReaderRAW.readAsBinaryString(imageSwitch.files[0]);
          imageReaderRAW.addEventListener("load", function () {
            if (imageStore === null) {
              imageStore = {};
              imageStore['poster'] = null;
              imageStore['cover'] = null;
              imageStore['gallery'] = [];
            }

            imageStore[type] = btoa(imageReaderRAW.result); // console.log(imageStore[type]);
          }, false);
        } else {
          injectNoti('<p>Oi, your picture too big already la! (╬ Ò﹏Ó)<br><br><strong>16MB MAXIMUM HELLO</strong></p>', null, 8000); // clear file selection

          imageSwitch.value = null;
        }
      } else {
        injectNoti('<p>Invalid image. Ensure that the image is an image... (o-_-o)', null, 6000); // clear file selection

        imageSwitch.value = null;
      }
    } // console.log(type);
    // console.log(imageSwitch.files);

  }
}; // END articleImage
// BEGIN articleCreate


var articleInsertState = false;

articleInsertControl = function articleInsertControl(stage, stage2) {
  if (user['accrisk'] === true) {
    if (articleInsertState === false) {
      // enable insert
      articleInsertInjector(true);
      articleInsertState = true;
      injectNoti('<p>You are now in Create Mode. Click on elements to edit details. </p>', null, 6000);
      articleInsertButtonControl('edit');
    } else if (articleInsertState === true && stage === undefined && stage2 === true) {
      //upload file success, let's proceed to save
      articleInsertServer(null, articleInsertCollector()); //pass null for injection
    } else if (articleInsertState === true && stage === undefined && stage2 === false) {
      // upload file failed, proceed also but warn that file upload has problem
      articleInsertServer(null, articleInsertCollector()); //pass null for injection

      injectNoti('<p>An error occured while uploading images, therefore images will be excluded from movie details. </p>', null, 6000);
    } else if (articleInsertState === true && stage === 'discard') {
      // discard insert
      articleInsertInjector(false);
      articleInsertState = false;
      injectNoti('<p>Movie discarded. </p>', null, 5000);
      articleInsertButtonControl();
    } else if (articleInsertState === true && stage === undefined) {
      // disable insert and save to server (inject)
      articleInsertInjector(false);

      if (articleInsertCollector() !== false) {
        articleInsertButtonControl('save'); // upload images

        if (imageStore != null) {
          imageControl('risk-articleInsert', 'insert', imageStore);
        } else {
          articleInsertServer(null, articleInsertCollector()); //pass null for injection   
        }
      } else {
        // invalid input detected, fallback to edit mode
        articleInsertInjector(true);
        articleInsertState = true;
        articleInsertButtonControl('edit');
      }
    } else if (articleInsertState === true && stage === true) {
      // saved, everything looks good
      articleInsertInjector(false);
      articleInsertState = false;
      injectNoti('<p>Movie saved successfully. </p>', null, 5000);
      articleInsertButtonControl('saved');
      contentControl('browse-sub-insert', true); // contentcontrol is also sub content toggle, thus trigger twice to remain on the sub content container (prevent dismiss)
    } else if (articleInsertState === true && stage === false) {
      // no, it does not look good. Fall back to edit mode
      articleInsertInjector(true);
      articleInsertState = true;
      injectNoti('<p>Failed to save changes. Consult administrator for more information. </p>', null, 6000);
      articleInsertButtonControl('edit');
    }
  }
};

articleInsertServer = function articleInsertServer(state, articleArray) {
  if (state === true) {
    // server return success status
    articleInsertControl(true);
  } else if (state === null && articleArray) {
    // perform server inject
    articleServer('risk-articleInsert', 'insert', JSON.stringify(articleArray));
  } else if (state === false) {
    // server returned fail status
    articleInsertControl(false);
  }
};

articleInsertInjector = function articleInsertInjector(isInject) {
  var elementNode = [document.getElementById('browse-sub-cover-details-rating'), document.getElementById('browse-sub-cover-details-score'), document.getElementById('browse-sub-cover-details-title'), document.getElementById('browse-sub-cover-details-title2'), document.getElementById('browse-sub-cover-details-desc'), // document.getElementById('browse-sub-section-sidebar-details-year'),
  document.getElementById('browse-sub-section-sidebar-details-rating'), document.getElementById('browse-sub-section-sidebar-details-lang'), document.getElementById('browse-sub-section-sidebar-details-subtitle'), document.getElementById('browse-sub-section-sidebar-details-duration'), document.getElementById('browse-sub-section-sidebar-details-genre'), document.getElementById('browse-sub-section-sidebar-details-country'), document.getElementById('browse-sub-section-sidebar-details-director'), document.getElementById('browse-sub-section-sidebar-details-cast'), document.getElementById('browse-sub-section-main-details-desc2')];
  elementNode.forEach(function (element) {
    element.setAttribute('contenteditable', isInject);
  });

  if (isInject) {
    document.getElementById('browse-sub-cover-details-rating').setAttribute('title', 'Valid Values: ' + 'U, P13, 18');
    document.getElementById('browse-sub-cover-details-score').setAttribute('title', 'Valid Values: ' + '0.0 - 10.0');
    document.getElementById('browse-sub-cover-details-title').setAttribute('title', 'Enter movie title here (ie. English title)');
    document.getElementById('browse-sub-cover-details-title2').setAttribute('title', 'Enter additional movie title here (ie. Japanese title or Chinese title)');
    document.getElementById('browse-sub-cover-details-desc').setAttribute('title', 'Enter short movie description here');
    document.getElementById('browse-sub-cover-details-score').addEventListener("input", function () {
      document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML = textTrim(document.getElementById('browse-sub-cover-details-score').innerHTML);
    });
    document.getElementById('browse-sub-section-sidebar-details-rating').addEventListener("input", function () {
      document.getElementById('browse-sub-cover-details-score').innerHTML = textTrim(document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML);
    }); // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.add('disabled'); //disable edit rating in secondary compartment
    // document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.add('disabled'); //disable edit year in secondary compartment
  } else {
    elementNode.forEach(function (element) {
      element.removeAttribute('title');
    }); // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.remove('disabled')
    // document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.remove('disabled');
  }
};

articleInsertButtonControl = function (_articleInsertButtonControl) {
  function articleInsertButtonControl(_x) {
    return _articleInsertButtonControl.apply(this, arguments);
  }

  articleInsertButtonControl.toString = function () {
    return _articleInsertButtonControl.toString();
  };

  return articleInsertButtonControl;
}(function (state) {
  var elementNode = document.getElementById('dashboard-content-sub-nav-childnode-edit');
  var elementNodeBack = document.getElementById('dashboard-content-sub-nav-childnode-back'); // var elementNodeDelete = document.getElementById('dashboard-content-sub-nav-childnode-delete');

  elementNode.classList.remove('disabled'); // elementNodeDelete.classList.add('hidden');

  elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleInsertControl('discard')", ''));
  elementNode.setAttribute('onclick', "articleInsertControl(undefined)");
  contentSubAllowsEscape = true;

  if (state == 'edit') {
    // elementNode.classList.remove('disabled');
    elementNode.style.setProperty('color', 'crimson');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVE';
    elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleInsertControl('discard')", '') + ";articleInsertControl('discard')");
    document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.add('hidden');
  } else if (state == 'save') {
    elementNode.classList.add('disabled');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVING';
    contentSubAllowsEscape = false; // elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')",''));
  } else if (state == 'saved') {
    // elementNode.classList.remove('disabled');
    elementNode.style.setProperty('color', 'deepskyblue');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVED';
    var onclick = elementNode.getAttribute('onclick');
    elementNode.removeAttribute('onclick');
    setTimeout(function () {
      articleInsertButtonControl(null);
      elementNode.setAttribute('onclick', onclick);
    }, 2500); // contentSubAllowsEscape = true;
  } else {
    elementNode.style.setProperty('color', 'burlywood');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'EDIT';
    document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.remove('hidden');
  }
});

articleInsertCollector = function articleInsertCollector() {
  var iserror = []; // var isInsert = 0;
  // var articleArray = false;

  if (articleInsertState) {
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
    var localyear = document.getElementById('browse-sub-section-sidebar-details-year').value; // var localrating2 = document.getElementById('browse-sub-section-sidebar-details-rating'); //score

    var locallang = document.getElementById('browse-sub-section-sidebar-details-lang').innerHTML;
    var localsubtitle = document.getElementById('browse-sub-section-sidebar-details-subtitle').innerHTML;
    var localduration = document.getElementById('browse-sub-section-sidebar-details-duration').innerHTML;
    var localgenre = document.getElementById('browse-sub-section-sidebar-details-genre').innerHTML;
    var localcountry = document.getElementById('browse-sub-section-sidebar-details-country').innerHTML;
    var localdirector = document.getElementById('browse-sub-section-sidebar-details-director').innerHTML;
    var localcast = document.getElementById('browse-sub-section-sidebar-details-cast').innerHTML;
    var localdescription2 = document.getElementById('browse-sub-section-main-details-desc2').innerHTML; // rating

    if (localrating) {
      if (textTrim(localrating).toUpperCase()) {
        if (textTrim(localrating).toUpperCase() == 'P13' || textTrim(localrating).toUpperCase() == 'U' || textTrim(localrating).toUpperCase() == '18') {
          articleArray['rating'] = textTrim(localrating).toUpperCase();
        } else {
          iserror.push('film censorship rating');
        }
      }
    } else {
      iserror.push('film censorship rating');
    } // score


    if (parseFloat(textTrim(localscore)).toFixed(1)) {
      if (parseFloat(textTrim(localscore)).toFixed(1) >= 0.0 && parseFloat(textTrim(localscore)).toFixed(1) <= 10.0) {
        articleArray['score'] = parseFloat(textTrim(localscore)).toFixed(1);
      } else {
        iserror.push('rating');
      }
    } // title


    if (textTrim(localtitle)) {
      if (textTrim(localtitle).length) {
        articleArray['title'] = textTrim(localtitle);
      } else {
        iserror.push('title');
      }
    } // title2


    if (textTrim(localtitle2)) {
      // if(textTrim(localtitle2).length){
      // allow empty
      articleArray['title2'] = textTrim(localtitle2); // }else{
      //     iserror.push('secondary title');
      // }
    } // desc


    if (textTrim(localdescription) != articleArray['description'] || textTrim(localdescription) != articleArray2['description']) {
      // if(textTrim(localdescription).length){
      // allow empty
      articleArray['description'] = textTrim(localdescription); // }else{
      //     iserror.push('description');
      // }
    } // year


    if (localyear) {
      articleArray['reldate'] = localyear;
    } else {
      iserror.push('date');
    } // lang


    if (locallang) {
      if (textTrim(locallang).toUpperCase().replaceAll('--', '')) {
        if (textTrim(locallang).length) {
          articleArray['lang']['lang'] = textTrim(locallang).toUpperCase().replaceAll('--', '').split(' ');

          if (articleArray['lang']['lang'] == '') {
            articleArray['lang']['lang'] = [];
          }
        } else {
          iserror.push('language');
        }
      }
    } else {
      iserror.push('language');
    } // sub


    if (localsubtitle) {
      if (textTrim(localsubtitle).toUpperCase().replaceAll('--', '')) {
        if (textTrim(localsubtitle).length) {
          articleArray['subtitle']['lang'] = textTrim(localsubtitle).toUpperCase().replaceAll('--', '').split(' '); // console.log(articleArray['subtitle']['lang']);

          if (articleArray['subtitle']['lang'] == '') {
            articleArray['subtitle']['lang'] = [];
          } // console.log(articleArray['subtitle']['lang']);

        } else {
          iserror.push('subtitle');
        } // console.log(articleArray['subtitle']['lang']);

      }
    } else {
      iserror.push('subtitle');
    } // console.log(articleArray['subtitle']['lang']);
    // duration


    if (parseInt(textTrim(localduration))) {
      if (parseInt(textTrim(localduration)) >= 0) {
        articleArray['runtime'] = parseInt(textTrim(localduration));
      } else {
        iserror.push('duration');
      }
    } // genre


    if (localgenre) {
      if (textTrim(localgenre).toUpperCase().replaceAll('--', '')) {
        if (textTrim(localgenre).length) {
          articleArray['genre']['tags'] = textTrim(localgenre).toUpperCase().replaceAll('--', '').split(' ');

          if (articleArray['genre']['tags'] == '') {
            articleArray['genre']['tags'] = [];
          }
        } else {
          iserror.push('genre');
        }
      }
    } else {
      iserror.push('genre');
    } // country


    if (localcountry) {
      if (textTrim(localcountry).toUpperCase().replaceAll('--', '')) {
        if (textTrim(localcountry).length) {
          articleArray['country'] = textTrim(localcountry).toUpperCase().replaceAll('--', '');
        } else {
          iserror.push('country');
        }
      }
    } else {
      iserror.push('country');
    } // director (todo: allow empty)


    if (localdirector) {
      if (textTrim(localdirector).toUpperCase().replaceAll('--', '')) {
        if (textTrim(localdirector).length) {
          articleArray['director'] = textTrim(localdirector).toUpperCase().replaceAll('--', '');
        } else {
          iserror.push('director');
        }
      }
    } else {
      iserror.push('director');
    } // cast (todo: allow empty)


    if (localcast) {
      if (textTrim2(localcast).toUpperCase().replaceAll('--', '')) {
        if (textTrim2(localcast).length) {
          articleArray['cast']['star'] = textTrim2(localcast).toUpperCase().replaceAll('--', '').split('<BR>');

          if (articleArray['cast']['star'] == '') {
            articleArray['cast']['star'] = [];
          }
        } else {
          iserror.push('cast');
        }
      }
    } else {
      iserror.push('cast');
    } // desc2


    if (textTrim(localdescription2)) {
      if (textTrim(localdescription2).length) {
        articleArray['description2'] = textTrim(localdescription2);
      } else {
        iserror.push('long description');
      }
    }
  }

  if (imageStore2 != null) {
    articleArray['visual']['poster'] = imageStore2[0];
    articleArray['visual']['cover'] = imageStore2[1];
    articleArray['visual']['gallery'] = imageStore[2];
  }

  if (iserror.length) {
    injectNoti("Invalid " + iserror.join(', ') + ". Ensure that details are entered correctly. ");
    return false;
  } else {
    return articleArray;
  }
}; // END arrticleCreate
// BEGIN articleEdit


var articleEditState = false;

articleEditControl = function articleEditControl(articleid, stage, stage2) {
  if (articleid && user['accrisk'] == 1) {
    articleid = articleid.toUpperCase();

    if (articleEditState === false) {
      // enable edit
      articleEditInjector(true);
      articleEditState = true;
      injectNoti('<p>You are now in Edit Mode. Click on elements to edit details. </p>', null, 6000);
      articleEditButtonControl('edit');
    } else if (articleEditState === true && stage === undefined && stage2 === true) {
      //upload file success, let's proceed to save
      articleEditServer(articleid, null, articleEditCollector(articleid)); //pass null for injection
    } else if (articleEditState === true && stage === undefined && stage2 === false) {
      // upload file failed, proceed also but warn that file upload has problem
      articleEditServer(articleid, null, articleEditCollector(articleid)); //pass null for injection

      injectNoti('<p>An error occured while uploading images, therefore images will be excluded from updating movie details. </p>', null, 6000);
    } else if (articleEditState === true && articleid.toLowerCase() === 'discard') {
      // discard edit
      articleEditInjector(false);
      articleEditState = false;
      injectNoti('<p>Changes discarded. </p>', null, 5000);
      articleEditButtonControl();
    } else if (articleEditState === true && stage === undefined) {
      // disable edit and save to server (inject)
      articleEditInjector(false);

      if (articleEditCollector(articleid) !== false) {
        articleEditButtonControl('save');

        if (articleEditCollector(articleid) !== null) {
          if (imageStore != null) {
            imageControl('risk-articleEdit', 'insert', imageStore, articleid);
          } else {
            articleEditServer(articleid, null, articleEditCollector(articleid)); //pass null for injection
          }
        } else {
          injectNoti("No changes detected. ");
          articleEditState = false;
          articleEditButtonControl();
        }
      } else {
        // invalid input detected, fallback to edit mode
        articleEditInjector(true);
        articleEditState = true;
        articleEditButtonControl('edit');
      }
    } else if (articleEditState === true && stage === true) {
      // saved, everything looks good
      articleEditInjector(false);
      articleEditState = false;
      injectNoti('<p>Changes saved successfully. </p>', null, 5000);
      articleEditButtonControl('saved');
      contentControl('browse-sub', articleid);
      contentControl('browse-sub', articleid); // contentcontrol is also sub content toggle, thus trigger twice to remain on the sub content container (prevent dismiss)
    } else if (articleEditState === true && stage === false) {
      // no, it does not look good. Fall back to edit mode
      articleEditInjector(true);
      articleEditState = true;
      injectNoti('<p>Failed to save changes. Consult administrator for more information. </p>', null, 6000);
      articleEditButtonControl('edit');
    }
  }
};

articleEditServer = function articleEditServer(articleid, state, articleArray) {
  if (articleid && state === true) {
    // server return success status
    articleEditControl(articleid, true);
  } else if (articleid && state === null && articleArray) {
    // perform server inject
    articleServer('risk-articleEdit', 'update', JSON.stringify(articleArray), articleid);
  } else if (articleid && state === false) {
    // server returned fail status
    articleEditControl(articleid, false);
  }
};

articleEditInjector = function articleEditInjector(isInject) {
  var elementNode = [document.getElementById('browse-sub-cover-details-rating'), document.getElementById('browse-sub-cover-details-score'), document.getElementById('browse-sub-cover-details-title'), document.getElementById('browse-sub-cover-details-title2'), document.getElementById('browse-sub-cover-details-desc'), // document.getElementById('browse-sub-section-sidebar-details-year'),
  document.getElementById('browse-sub-section-sidebar-details-rating'), document.getElementById('browse-sub-section-sidebar-details-lang'), document.getElementById('browse-sub-section-sidebar-details-subtitle'), document.getElementById('browse-sub-section-sidebar-details-duration'), document.getElementById('browse-sub-section-sidebar-details-genre'), document.getElementById('browse-sub-section-sidebar-details-country'), document.getElementById('browse-sub-section-sidebar-details-director'), document.getElementById('browse-sub-section-sidebar-details-cast'), document.getElementById('browse-sub-section-main-details-desc2')];
  elementNode.forEach(function (element) {
    element.setAttribute('contenteditable', isInject);
  });

  if (isInject) {
    document.getElementById('browse-sub-cover-details-rating').setAttribute('title', 'Valid Values: ' + 'U, P13, 18');
    document.getElementById('browse-sub-cover-details-score').setAttribute('title', 'Valid Values: ' + '0.0 - 10.0');
    document.getElementById('browse-sub-cover-details-title').setAttribute('title', 'Enter movie title here (ie. English title)');
    document.getElementById('browse-sub-cover-details-title2').setAttribute('title', 'Enter additional movie title here (ie. Japanese title or Chinese title)');
    document.getElementById('browse-sub-cover-details-desc').setAttribute('title', 'Enter short movie description here');
    document.getElementById('browse-sub-cover-details-score').addEventListener("input", function () {
      document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML = textTrim(document.getElementById('browse-sub-cover-details-score').innerHTML);
    });
    document.getElementById('browse-sub-section-sidebar-details-rating').addEventListener("input", function () {
      document.getElementById('browse-sub-cover-details-score').innerHTML = textTrim(document.getElementById('browse-sub-section-sidebar-details-rating').innerHTML);
    }); // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.add('disabled'); //disable edit rating in secondary compartment

    document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.add('disabled'); //disable edit year in secondary compartment

    document.getElementById('browse-sub-cover-imagePrompt').classList.remove('hidden');
  } else {
    elementNode.forEach(function (element) {
      element.removeAttribute('title');
    }); // document.getElementById('browse-sub-section-sidebar-details-rating').parentElement.classList.remove('disabled')

    document.getElementById('browse-sub-section-sidebar-details-year').parentElement.classList.remove('disabled');
    document.getElementById('browse-sub-cover-imagePrompt').classList.add('hidden');
  }
};

articleEditButtonControl = function articleEditButtonControl(state) {
  var elementNode = document.getElementById('dashboard-content-sub-nav-childnode-edit');
  var elementNodeBack = document.getElementById('dashboard-content-sub-nav-childnode-back');
  var elementNodeDelete = document.getElementById('dashboard-content-sub-nav-childnode-delete');
  elementNode.classList.remove('disabled');
  elementNodeDelete.classList.remove('disabled');
  elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')", ''));
  contentSubAllowsEscape = true;

  if (state == 'edit') {
    // elementNode.classList.remove('disabled');
    elementNode.style.setProperty('color', 'crimson');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVE';
    elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')", '') + ";articleEditControl('discard')");
  } else if (state == 'save') {
    elementNode.classList.add('disabled');
    elementNodeDelete.classList.add('disabled');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVING';
    contentSubAllowsEscape = false; // elementNodeBack.setAttribute('onclick', elementNodeBack.getAttribute('onclick').replaceAll(";articleEditControl('discard')",''));
  } else if (state == 'saved') {
    // elementNode.classList.remove('disabled');
    elementNode.style.setProperty('color', 'deepskyblue');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'SAVED';
    var onclick = elementNode.getAttribute('onclick');
    elementNode.removeAttribute('onclick');
    setTimeout(function () {
      elementNode.style.setProperty('color', 'burlywood');
      elementNode.getElementsByTagName('span')[1].innerHTML = 'EDIT';
      elementNode.setAttribute('onclick', onclick);
    }, 2500); // contentSubAllowsEscape = true;
  } else {
    elementNode.style.setProperty('color', 'burlywood');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'EDIT';
  }
};

articleEditCollector = function articleEditCollector(articleid) {
  var iserror = [];
  var isEdit = 0;
  var articleArray = false;

  if (globalArticle) {
    for (var i = 0; i < globalArticle.length; i++) {
      if (globalArticle[i]['articleid'].toUpperCase() == articleid.toUpperCase()) {
        articleArray = globalArticle[i];
        i = globalArticle.length;
      } else {
        articleArray = false;
      }
    }

    ;
  }

  if (articleEditState && articleArray !== false) {
    // var articleArray2 = [...articleArray]; not applicable for 2D array
    var articleArray2 = {};
    articleArray2['articleid'] = articleArray['articleid'];
    articleArray2['visible'] = '1';
    articleArray2['title'] = articleArray['title'];
    articleArray2['title2'] = articleArray['title2'];
    articleArray2['description'] = articleArray['description'];
    articleArray2['description2'] = articleArray['description2'];
    articleArray2['genre'] = {};
    articleArray2['genre']['tags'] = _objectSpread({}, articleArray['genre']['tags']);
    articleArray2['lang'] = {};
    articleArray2['lang']['lang'] = _objectSpread({}, articleArray['lang']['lang']);
    articleArray2['subtitle'] = {};
    articleArray2['subtitle']['lang'] = _objectSpread({}, articleArray['subtitle']['lang']);
    articleArray2['country'] = articleArray['country'];
    articleArray2['rating'] = articleArray['rating'];
    articleArray2['score'] = articleArray['score'];
    articleArray2['runtime'] = articleArray['runtime'];
    articleArray2['director'] = articleArray['director'];
    articleArray2['cast'] = {};
    articleArray2['cast']['star'] = _objectSpread({}, articleArray['cast']['star']);
    articleArray2['reldate'] = articleArray['reldate'];
    articleArray2['visual'] = {};
    articleArray2['visual']['poster'] = articleArray['visual']['poster'];
    articleArray2['visual']['cover'] = articleArray['visual']['cover'];
    articleArray2['visual']['gallery'] = _objectSpread({}, articleArray['visual']['gallery']);
    var localrating = document.getElementById('browse-sub-cover-details-rating').innerHTML;
    var localscore = document.getElementById('browse-sub-cover-details-score').innerHTML;
    var localtitle = document.getElementById('browse-sub-cover-details-title').innerHTML;
    var localtitle2 = document.getElementById('browse-sub-cover-details-title2').innerHTML;
    var localdescription = document.getElementById('browse-sub-cover-details-desc').innerHTML; // var localyear = document.getElementById('browse-sub-section-sidebar-details-year').innerHTML;
    // var localrating2 = document.getElementById('browse-sub-section-sidebar-details-rating'); //score

    var locallang = document.getElementById('browse-sub-section-sidebar-details-lang').innerHTML;
    var localsubtitle = document.getElementById('browse-sub-section-sidebar-details-subtitle').innerHTML;
    var localduration = document.getElementById('browse-sub-section-sidebar-details-duration').innerHTML;
    var localgenre = document.getElementById('browse-sub-section-sidebar-details-genre').innerHTML;
    var localcountry = document.getElementById('browse-sub-section-sidebar-details-country').innerHTML;
    var localdirector = document.getElementById('browse-sub-section-sidebar-details-director').innerHTML;
    var localcast = document.getElementById('browse-sub-section-sidebar-details-cast').innerHTML;
    var localdescription2 = document.getElementById('browse-sub-section-main-details-desc2').innerHTML; // rating

    if (localrating) {
      if (textTrim(localrating).toUpperCase() != articleArray['rating'].toUpperCase() || textTrim(localrating).toUpperCase() != articleArray2['rating'].toUpperCase()) {
        if (textTrim(localrating).toUpperCase() == 'P13' || textTrim(localrating).toUpperCase() == 'U' || textTrim(localrating).toUpperCase() == '18') {
          articleArray2['rating'] = textTrim(localrating).toUpperCase();
          isEdit++;
        } else {
          iserror.push('film censorship rating');
        }
      }
    } else {
      iserror.push('film censorship rating');
    } // score


    if (parseFloat(textTrim(localscore)).toFixed(1) != articleArray['score'] || parseFloat(textTrim(localscore)).toFixed(1) != articleArray2['score']) {
      if (parseFloat(textTrim(localscore)).toFixed(1) >= 0.0 && parseFloat(textTrim(localscore)).toFixed(1) <= 10.0) {
        articleArray2['score'] = parseFloat(textTrim(localscore)).toFixed(1);
        isEdit++;
      } else {
        iserror.push('rating');
      }
    } // title


    if (textTrim(localtitle) != articleArray['title'] || textTrim(localtitle) != articleArray2['title']) {
      if (textTrim(localtitle).length) {
        articleArray2['title'] = textTrim(localtitle);
        isEdit++;
      } else {
        iserror.push('title');
      }
    } // title2


    if (textTrim(localtitle2) != articleArray['title2'] || textTrim(localtitle2) != articleArray2['title2']) {
      // if(textTrim(localtitle2).length){
      // allow empty
      articleArray2['title2'] = textTrim(localtitle2);
      isEdit++; // }else{
      //     iserror.push('secondary title');
      // }
    } // desc


    if (textTrim(localdescription) != articleArray['description'] || textTrim(localdescription) != articleArray2['description']) {
      // if(textTrim(localdescription).length){
      // allow empty
      articleArray2['description'] = textTrim(localdescription);
      isEdit++; // }else{
      //     iserror.push('description');
      // }
    } // year
    // if(parseInt(textTrim(localyear)) != articleArray['year'] || parseInt(textTrim(localyear)) != articleArray2['year']){
    //     if(parseInt(textTrim(localyear)) > 1000){
    //         articleArray2['year'] = parseInt(textTrim(localyear));
    //     }else{
    //         iserror.push('year');
    //     }
    // }
    // lang


    if (locallang) {
      if (textTrim(locallang).toUpperCase().replaceAll('--', '') != articleArray['lang']['lang'].toString().toUpperCase() || textTrim(localrating).replaceAll('--', '') != articleArray2['lang']['lang'].toString().toUpperCase()) {
        if (textTrim(locallang).length) {
          articleArray2['lang']['lang'] = textTrim(locallang).toUpperCase().replaceAll('--', '').split(' ');
          isEdit++;

          if (articleArray2['lang']['lang'] == '') {
            articleArray2['lang']['lang'].length = 0;
          }
        } else {
          iserror.push('language');
        }
      }
    } else {
      iserror.push('language');
    } // sub


    if (localsubtitle) {
      if (textTrim(localsubtitle).toUpperCase().replaceAll('--', '') != articleArray['subtitle']['lang'].toString().toUpperCase() || textTrim(localsubtitle).replaceAll('--', '') != articleArray2['subtitle']['lang'].toString().toUpperCase()) {
        if (textTrim(localsubtitle).length) {
          articleArray2['subtitle']['lang'] = textTrim(localsubtitle).toUpperCase().replaceAll('--', '').split(' ');
          isEdit++;

          if (articleArray2['subtitle']['lang'] == '') {
            articleArray2['subtitle']['lang'].length = 0;
          }
        } else {
          iserror.push('subtitle');
        }
      }
    } else {
      iserror.push('subtitle');
    } // duration


    if (parseInt(textTrim(localduration)) != articleArray['runtime'] || parseInt(textTrim(localduration)) != articleArray2['runtime']) {
      if (parseInt(textTrim(localduration)) >= 0) {
        articleArray2['runtime'] = parseInt(textTrim(localduration));
        isEdit++;
      } else {
        iserror.push('duration');
      }
    } // genre


    if (localgenre) {
      if (textTrim(localgenre).toUpperCase().replaceAll('--', '') != articleArray['genre']['tags'].toString().toUpperCase() || textTrim(localgenre).replaceAll('--', '') != articleArray2['genre']['tags'].toString().toUpperCase()) {
        if (textTrim(localgenre).length) {
          articleArray2['genre']['tags'] = textTrim(localgenre).toUpperCase().replaceAll('--', '').split(' ');
          isEdit++;

          if (articleArray2['genre']['tags'] == '') {
            articleArray2['genre']['tags'].length = 0;
          }
        } else {
          iserror.push('genre');
        }
      }
    } else {
      iserror.push('genre');
    } // country


    if (localcountry) {
      if (textTrim(localcountry).toUpperCase().replaceAll('--', '') != articleArray['country'].toUpperCase() || textTrim(localcountry).toUpperCase().replaceAll('--', '') != articleArray2['country'].toUpperCase()) {
        if (textTrim(localcountry).length) {
          articleArray2['country'] = textTrim(localcountry).toUpperCase().replaceAll('--', '');
          isEdit++;
        } else {
          iserror.push('country');
        }
      }
    } else {
      iserror.push('country');
    } // director (todo: allow empty)


    if (localdirector) {
      if (textTrim(localdirector).toUpperCase().replaceAll('--', '') != articleArray['director'].toUpperCase() || textTrim(localdirector).toUpperCase().replaceAll('--', '') != articleArray2['director'].toUpperCase()) {
        if (textTrim(localdirector).length) {
          articleArray2['director'] = textTrim(localdirector).toUpperCase().replaceAll('--', '');
          isEdit++;
        } else {
          iserror.push('director');
        }
      }
    } else {
      iserror.push('director');
    } // cast (todo: allow empty)


    if (localcast) {
      if (textTrim2(localcast).toUpperCase().replaceAll('--', '') != articleArray['cast']['star'].toString().toUpperCase() || textTrim2(localcast).replaceAll('--', '') != articleArray2['cast']['star'].toString().toUpperCase()) {
        if (textTrim2(localcast).length) {
          articleArray2['cast']['star'] = textTrim2(localcast).toUpperCase().replaceAll('--', '').split('<BR>');
          isEdit++;

          if (articleArray2['cast']['star'] == '') {
            articleArray2['cast']['star'].length = 0;
          }
        } else {
          iserror.push('cast');
        }
      }
    } else {
      iserror.push('cast');
    } // desc2


    if (textTrim(localdescription2) != articleArray['description2'] || textTrim(localdescription2) != articleArray2['description2']) {
      if (textTrim(localdescription2).length) {
        articleArray2['description2'] = textTrim(localdescription2);
        isEdit++;
      } else {
        iserror.push('long description');
      }
    }
  }

  if (iserror.length) {
    injectNoti("Invalid " + iserror.join(', ') + ". Ensure that details are entered correctly. ");
    return false;
  } else {
    if (imageStore2 != null) {
      if (imageStore2[0] != null && imageStore2[0] != '') {
        articleArray2['visual']['poster'] = imageStore2[0];
      }

      if (imageStore2[1] != null && imageStore2[1] != '') {
        articleArray2['visual']['cover'] = imageStore2[1];
      }

      if (imageStore2[2] != null && imageStore2[2] != '' && imageStore2['visual']['gallery'] != []) {
        articleArray2['visual']['gallery'] = imageStore2[2];
      }
    }

    if (isEdit && !(JSON.stringify(articleArray) == JSON.stringify(articleArray2))) {
      // console.log(articleArray2);
      return articleArray2;
    } else {
      // injectNoti("No changes detected. ");
      return null;
    }
  }
}; // END articleEdit
// START articleDelete


var isDeletePrompt = false;

articleDeleteControl = function articleDeleteControl(articleid, state) {
  // console.log(articleid, state);
  if (user['accrisk'] === true) {
    var elementNode = document.getElementById('dashboard-content-sub-nav-childnode-delete');
    elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETE';

    if (elementNode.classList.contains('hidden')) {// do nothing
    } else {
      elementNode.classList.remove('disabled');

      if (state === true && isDeletePrompt === false && articleid && articleid !== true) {
        isDeletePrompt = true;
        elementNode.getElementsByTagName('span')[1].innerHTML = 'CONFIRM?';
      } else if (state === true && isDeletePrompt === true && articleid && articleid !== true) {
        isDeletePrompt = false;
        elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETING';
        elementNode.classList.add('disabled');
        articleDeleteServer(null, articleid);
      } else if (state === true && articleid === true) {
        if (articleEditState == true) {
          articleEditControl('discard');
        }

        contentControl(true, true); // console.log('wow');

        elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETE';
        injectNoti('<p>Movie deleted. </p>', null, 5000);
      } else if (state === false && articleid === false) {
        elementNode.getElementsByTagName('span')[1].innerHTML = 'DELETE';
        elementNode.classList.remove('disabled');
        injectNoti('<p>Failed to perform deletion. Consult administrator for more information. </p>', null, 6000);
      }
    }
  }
};

articleDeleteServer = function articleDeleteServer(state, articleid) {
  if (state === true) {
    // server return success status
    // console.log('test');
    articleDeleteControl(true, true);
  } else if (state === null && articleid) {
    // perform server inject
    articleServer('risk-articleDelete', 'delete', articleid);
  } else if (state === false) {
    // server returned fail status
    articleDeleteControl(false, false);
  }
};

articleDeleteButtonControl = function articleDeleteButtonControl(state, articleid) {}; // END articleDelete

/***/ }),

/***/ "./resources/js/views/mirui-dashboard-transaction.js":
/*!***********************************************************!*\
  !*** ./resources/js/views/mirui-dashboard-transaction.js ***!
  \***********************************************************/
/***/ (() => {

transactionControl = function transactionControl(level, isInjected, isProcess) {
  if (!isInjected && isProcess) {
    transactionBuffer(true);

    if (level == 'checkout') {
      transactionServer(false);
    } else if (level == 'payment') {
      if (transactionPaymentInputControl(true)) {
        transactionServer(transactionPaymentInputControl(true));
      } else {
        transactionBuffer(10);
      }
    } else if (level == 'complete') {
      transactionInject(level);
    }
  } else if (!isInjected) {
    // at landing
    transactionBuffer(true);
    transactionInject(level);
  } else if (isInjected && level) {
    var progressCount = 10;

    if (level == 'payment') {// progressCount = 40;
    } else if (level == 'complete') {
      progressCount = false;
    }

    setTimeout(function () {
      transactionBuffer(progressCount);
      document.getElementById('transaction-content-progress-label').innerHTML = level.toUpperCase();
    }, 750);
  }
};

transactionInject = function transactionInject(file) {
  if (file) {
    fetch(root + "dashboard/include/" + 'transaction-' + file + '.php', {
      method: 'post'
    }).then(function (var01) {
      return var01.text();
    }).then(function (var01) {
      document.getElementById('transaction-content-container').innerHTML = var01;

      if (file == 'checkout') {
        var coinConsume = cartCounter() * 5;
        var message = "You have " + cartCounter() + " movie(s) in cart";

        if (user['coin'] >= coinConsume) {
          message += " ready for checkout. ";
          var buttonText = "PAY WITH " + coinConsume + " COINS";
        } else {
          message += ", however your coins balance is low. ";
          var buttonText = "ADD COIN FIRST ._>";
          document.getElementById('transaction-content-checkout-prompt-next').classList.add('disabled');
        }

        document.getElementById('transaction-content-checkout-summary-text').innerHTML = message;
        document.getElementById('transaction-content-checkout-prompt-next').innerHTML = buttonText;
      }

      transactionControl(file, true);
    })["catch"](function (var01) {
      console.log(var01);
    });
  }
};

transactionBuffer = function transactionBuffer(isLoop) {
  if (isLoop === true) {
    document.getElementById('transaction-content-container').classList.add('disabled'); // document.getElementById('dashboard-content-sub-nav-childnode-back').classList.add('disabled');
    // contentSubAllowsEscape = false;
  } else {
    document.getElementById('transaction-content-container').classList.remove('disabled'); // document.getElementById('dashboard-content-sub-nav-childnode-back').classList.remove('disabled');
    // contentSubAllowsEscape = true;
  }

  transactionBufferProgress(isLoop);
};

transactionBufferProgress = function transactionBufferProgress(progress) {
  if (progress === true) {
    document.getElementById('transaction-content-progress-bar').classList.add('isBuffering');
  } else {
    document.getElementById('transaction-content-progress-bar').classList.remove('isBuffering');

    if (progress === false) {
      document.getElementById('transaction-content-progress-bar').style.setProperty('width', '100%');
    } else {
      document.getElementById('transaction-content-progress-bar').style.setProperty('width', progress + '%');
    }
  }
};

transactionPaymentControl = function transactionPaymentControl() {};

transactionPaymentInputControl = function transactionPaymentInputControl(mode, type) {
  var nodeCoin = document.getElementById('transaction-content-payment-coin');
  var nodeCNumber = document.getElementById('transaction-content-payment-cnumber');
  var nodeCDate = document.getElementById('transaction-content-payment-cdate');
  var nodeCCVV = document.getElementById('transaction-content-payment-ccvv');

  if (mode == 'input' && type) {
    // format card number
    if (type == 'cnumber') {
      nodeCNumber.value = nodeCNumber.value.trim();

      if (nodeCNumber.value.length == 4 || nodeCNumber.value.length == 9 || nodeCNumber.value.length == 14) {
        nodeCNumber.value += ' ';
      } // for(var i = 0, j = 1; i < nodeCNumber.value.length; i++){
      //     if(i == (4*j)+1){
      //         nodeCNumber.value[i-1] += ' ';
      //         i++;j++;
      //     }
      // }

    } else if (type == 'cdate') {
      nodeCDate.value = nodeCDate.value.trim();

      if (nodeCDate.value.length == 2) {
        nodeCDate.value += '/';
      }
    } else if (type == 'ccvv') {
      nodeCCVV.value = nodeCCVV.value.trim();
    } else if (type == 'coin') {
      nodeCoin.value = nodeCoin.value.trim();
    }
  } else if (mode === true) {
    if (parseInt(nodeCoin.value) < 5 || nodeCoin.value == '') {
      injectNoti('<p>Minimum topup amount of coin is 5. </p>', null, 6000);
    } else if (parseInt(nodeCoin.value) && parseInt(nodeCNumber.value) && parseInt(nodeCDate.value) && parseInt(nodeCCVV.value) && nodeCNumber.value.length == nodeCNumber.getAttribute('maxlength') && nodeCDate.value.length == nodeCDate.getAttribute('maxlength') && nodeCCVV.value.length == nodeCCVV.getAttribute('maxlength')) {
      return parseInt(nodeCoin.value);
    } else {
      injectNoti('<p>Invalid payment details. Ensure that payment details are correct. </p>', null, 6000);
    }

    return false;
  }
};

/***/ }),

/***/ "./resources/js/views/mirui-dashboard-user.js":
/*!****************************************************!*\
  !*** ./resources/js/views/mirui-dashboard-user.js ***!
  \****************************************************/
/***/ (() => {

userControl = function (_userControl) {
  function userControl(_x, _x2) {
    return _userControl.apply(this, arguments);
  }

  userControl.toString = function () {
    return _userControl.toString();
  };

  return userControl;
}(function (isInject, mode) {
  if (isInject === false && mode === false) {
    injectNoti('<p>Failed to retrieve user profile. Consult administrator for more information. </p>', null, 6000);
  } else if (!isInject && mode) {
    // fetch first so not injecting yet
    userServer(mode);
  } else if (isInject && mode === true) {
    userInject(true); // then we inject avatar, not injecting together prevent waiting

    if (userAvatar == null) {
      userControl(false, 'avatar');
    } else {
      userControl(true, 'avatar');
    }
  } else if (isInject && mode == 'avatar') {
    userInject('avatar');
  }
});

userInject = function userInject(mode) {
  var nodeUsername = document.getElementById('profile-overview-usercard-details-greeter-username');
  var nodeCoin = document.getElementById('profile-overview-usercard-details-coin');
  var nodeAvatar = document.getElementById('profile-overview-usercard-details-avatar');

  if (mode == 'avatar') {
    // inject the avatar
    if (userAvatar != null) {
      var nodeAvatar = document.getElementById('profile-overview-usercard-details-avatar').style.backgroundImage = 'url("' + userAvatar + '")';
    } // assume final stage of injection, let's reveal the usercard


    document.getElementById('profile-overview-usercard').classList.remove('disabled');
  } else if (mode === true) {
    // inject user info
    nodeUsername.innerHTML = user['name'].trim();
    nodeCoin.innerHTML = "You have " + user['coin'] + " coin(s) remaining. Click here to add coins. ";
  }
}; // BEGIN userAvatar


userAvatarControl = function userAvatarControl(callback) {
  var userAvatarNew = null;

  if (callback === undefined) {
    var imageSwitch = document.getElementById('profile-overview-usercard-details-avatar-core'); // imgtest = imageSwitch;

    if (imageSwitch.files && imageSwitch.files.length) {
      // var imageSel = imageSwitch.files[0]['type'];
      // check file type
      if (imageSwitch.files[0]['type'].indexOf('image/') === 0) {
        // it is an image, OK
        // check file size
        if (imageSwitch.files[0]['size'] < 16777216) {
          // file size below 16MB, OK
          //prepare file reader
          var imageReaderRAW = new FileReader(); // for preview just use object URL, cannot use base64 because too long
          // var imageStoreObject = URL.createObjectURL(imageSwitch.files[0]);
          // if(type == 'cover'){
          //     coverElement = document.getElementById('browse-sub-cover');
          //     coverElement.style.setProperty('background-image', 'var(--browse-gallery-node-shade), url(' + imageStoreObject + ')');
          // }
          // NO NEED PREVIEW LIAU LA...
          // this is for the RAW one

          imageReaderRAW.readAsBinaryString(imageSwitch.files[0]);
          imageReaderRAW.addEventListener("load", function () {
            userAvatarNew = btoa(imageReaderRAW.result); // console.log(imageStore[type]);

            if (userAvatarNew != null && userAvatarNew != undefined) {
              injectNoti('<p>Uploading profile picture... ヾ( `ー´)シφ__', null, 6000);
              userAvatarServer(userAvatarNew);
            } else {
              injectNoti('<p>An error occured while processing image upload. <br><br>Changes discarded. </p>', null, 8000);
            }
          }, false);
        } else {
          injectNoti('<p>Oi, your profile picture too big already la! (╬ Ò﹏Ó)<br><br><strong>16MB MAXIMUM HELLO</strong></p>', null, 8000); // clear file selection

          imageSwitch.value = null;
        }
      } else {
        injectNoti('<p>Invalid image. Ensure that the image is an image... (o-_-o)', null, 6000); // clear file selection

        imageSwitch.value = null;
      }
    } // console.log(type);
    // console.log(imageSwitch.files);

  } else if (callback === true) {
    injectNoti('<p>Upload successss!!! („• ֊ •„)', null, 6000);
    userControl(false, 'avatar');
  } else if (callback === false) {
    injectNoti('<p>An error occured while saving picture. <br>Changes discarded. </p>', null, 8000);
  }
};

/***/ }),

/***/ "./resources/js/views/mirui-dashboard.js":
/*!***********************************************!*\
  !*** ./resources/js/views/mirui-dashboard.js ***!
  \***********************************************/
/***/ (() => {

var contentSel = 0;
var contentSubAllowsEscape = true;
var contentPage = null;

greetInject = function greetInject() {
  var var01 = new Date().getHours();

  if (user['accrisk']) {
    var args01 = "ADMINISTRATOR";
    document.getElementById('dashboard-nav-greet-message').style.setProperty('color', 'darkred');
  } else if (var01 < 13) {
    var args01 = "GOOD MORNING";
  } else if (var01 < 17) {
    var args01 = "GOOD AFTERNOON";
  } else {
    var args01 = "GOOD EVENING";
  }

  document.getElementById('dashboard-nav-greet-message').innerHTML = args01; // if(!contentSel){
  //     earlyInit(); //onload(0)
  // }
};

contentControl = function contentControl(menuSel, articleid) {
  if (menuSel && articleid) {
    // sub section page
    var contentMain = document.getElementById('dashboard-content');
    var contentMain2 = document.getElementById('dashboard-nav-container');
    var contentSubNav = document.getElementById('dashboard-content-sub-nav');
    var contentSub = document.getElementById('dashboard-content-sub');

    if (contentSub.classList.contains('active') && contentSubAllowsEscape) {
      for (var i = 0; i < contentMain.children.length; i++) {
        contentMain.children[i].classList.remove('disabled');
      } // contentMain.style.removeProperty('cursor');


      contentMain.style.removeProperty('filter');
      contentMain2.style.removeProperty('filter');
      contentSub.classList.remove('active');
      contentSub.classList.remove('escapePrompt');
      contentSubNav.classList.remove('active');
      contentSubNav.classList.remove('escapePrompt'); // contentSubNav.removeAttribute('onclick');

      contentSubNav.removeAttribute('onmouseenter');
      contentSubNav.removeAttribute('onmouseout');
      setTimeout(function () {
        if (!contentSub.classList.contains('active')) {
          contentSub.innerHTML = '';
        }
      }, 500);
      imageStore = null;
      imageStore2 = null;
    } else if (!contentSub.classList.contains('active')) {
      for (var i = 0; i < contentMain.children.length; i++) {
        contentMain.children[i].classList.add('disabled');
      } // contentMain.style.setProperty('cursor', 'pointer');


      contentMain.style.setProperty('filter', 'blur(0.02rem)');
      contentMain2.style.setProperty('filter', 'blur(0.02rem)');
      contentSub.classList.add('active');
      contentSubNav.classList.add('active');
      contentInject(menuSel, articleid);
      setTimeout(function () {
        // contentSubNav.setAttribute("onclick", "contentControl(true, true);");
        contentSubNav.setAttribute("onmouseover", "document.getElementById('dashboard-content-sub').classList.add('escapePrompt'); document.getElementById('dashboard-content-sub-nav').classList.add('escapePrompt');");
        contentSubNav.setAttribute("onmouseout", "document.getElementById('dashboard-content-sub').classList.remove('escapePrompt'); document.getElementById('dashboard-content-sub-nav').classList.remove('escapePrompt');");
      }, 0); //500
    }
  } else if (menuSel) {
    if (contentSel) {
      // document.getElementsByTagName('SECTION')[0].classList.remove('unobstructive');
      document.getElementById('dashboard-content').innerHTML = '';
      document.getElementById('dashboard-content').classList.remove('active');
      document.getElementById('dashboard-nav-container').classList.remove('no-wrap');
      document.getElementById('dashboard-nav-menu-' + contentSel).classList.remove('active'); // document.getElementById('dashboard-nav-greet').classList.remove('max-height');

      contentPage = null;
    }

    if (contentSel != menuSel) {
      // setTimeout(function(){document.getElementsByTagName('SECTION')[0].classList.add('unobstructive')}, 500);
      document.getElementById('dashboard-nav-menu-' + menuSel).classList.add('active');
      document.getElementById('dashboard-nav-container').classList.add('no-wrap');
      document.getElementById('dashboard-content').classList.add('active'); // document.getElementById('dashboard-nav-greet').classList.add('max-height');

      contentSel = menuSel;
      contentInject(contentSel);
    } else {
      contentSel = null;
    }
  }
};

contentNavControl = function contentNavControl(file) {
  document.getElementById('dashboard-content-sub-nav-childnode-edit').classList.add('hidden');
  document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.add('hidden');
  document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.add('hidden');
  document.getElementById('dashboard-content-sub-nav-childnode-delete').classList.add('hidden');

  if (file == 'library') {
    // watch
    document.getElementById('dashboard-content-sub-nav-childnode-watch').classList.remove('hidden');
  } else if (file == 'cart' || file == 'browse' || file == 'browse-sub') {
    // add to cart
    document.getElementById('dashboard-content-sub-nav-childnode-cart').classList.remove('hidden');

    if ((file == 'browse' || file == 'browse-sub') && user['accrisk'] == 1) {
      document.getElementById('dashboard-content-sub-nav-childnode-edit').classList.remove('hidden');
      document.getElementById('dashboard-content-sub-nav-childnode-delete').classList.remove('hidden');
      isDeletePrompt = false;
      articleDeleteControl();
    }
  } else if (file == 'browse-sub-insert' && user['accrisk'] == 1) {
    // disable all icons except edit icon
    document.getElementById('dashboard-content-sub-nav-childnode-edit').classList.remove('hidden');
  }
};

contentInject = function contentInject(file, articleid) {
  if (file) {
    fetch(root + "dashboard/include/" + file + '.php', {
      method: 'post'
    }).then(function (var01) {
      return var01.text();
    }).then(function (var01) {
      if (articleid) {
        // file is a sub content
        document.getElementById('dashboard-content-sub').innerHTML = var01;

        if (articleid === true) {
          if (file == 'transaction') {
            //perform checkout
            if (contentPage == 'cart') {
              transactionControl('checkout', false);
            } else if (contentPage == 'profile') {
              transactionControl('payment', false);
            } //disable cart icon


            contentNavControl(file);
          } else if (file == 'browse-sub-insert') {
            articleInsertControl(null);
            contentNavControl(file);
          } // else if(file == 'browse-sub-insert'){
          //     //disable all the icons except for edit icon
          //     contentNavControl(file);
          //     document.getElementById('dashboard-content-sub-nav-childnode-back').setAttribute()
          // }

        } else if (file == 'browse-sub') {
          if (contentPage == 'library') {
            contentNavControl(contentPage);
          } else if (file == 'browse-sub' && contentPage == 'browse') {
            contentNavControl(file);
          } //default to article inject


          articleInject(articleid, true);

          if (contentPage == 'cart') {
            // reset the nav button as transaction checkout may override this
            contentNavControl('cart');
          }

          ;
        }
      } else {
        document.getElementById('dashboard-content').innerHTML = var01;
        contentPage = file;
        contentNavControl(contentPage);

        if (file == 'browse') {
          // browse is main and default
          articleControl(false);
        } else if (file == 'library') {
          // articleControl(false, file);
          libraryServer();
        } else if (file == 'cart') {
          // cartServer();
          articleControl(false, file);
        } else if (file == 'profile') {
          userControl(false, true);
        }
      }
    })["catch"](function (var01) {
      contentControl(contentSel);
      console.log(var01);
    });
  }
};

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*******************************!*\
  !*** ./resources/js/mirui.js ***!
  \*******************************/
__webpack_require__(/*! ./base */ "./resources/js/base.js");

__webpack_require__(/*! ./nav */ "./resources/js/nav.js"); // require('./article');


__webpack_require__(/*! ./components/article */ "./resources/js/components/article.js");

__webpack_require__(/*! ./components/asset */ "./resources/js/components/asset.js");

__webpack_require__(/*! ./components/cart */ "./resources/js/components/cart.js");

__webpack_require__(/*! ./components/library */ "./resources/js/components/library.js");

__webpack_require__(/*! ./components/noti */ "./resources/js/components/noti.js");

__webpack_require__(/*! ./components/transaction */ "./resources/js/components/transaction.js");

__webpack_require__(/*! ./components/user */ "./resources/js/components/user.js"); // require('./views/mirui-auth');
// require('./views/mirui-auth-login');
// require('./views/mirui-auth-register');


__webpack_require__(/*! ./views/mirui-dashboard */ "./resources/js/views/mirui-dashboard.js");

__webpack_require__(/*! ./views/mirui-dashboard-article */ "./resources/js/views/mirui-dashboard-article.js");

__webpack_require__(/*! ./views/mirui-dashboard-cart */ "./resources/js/views/mirui-dashboard-cart.js");

__webpack_require__(/*! ./views/mirui-dashboard-library */ "./resources/js/views/mirui-dashboard-library.js");

__webpack_require__(/*! ./views/mirui-dashboard-risk */ "./resources/js/views/mirui-dashboard-risk.js");

__webpack_require__(/*! ./views/mirui-dashboard-transaction */ "./resources/js/views/mirui-dashboard-transaction.js");

__webpack_require__(/*! ./views/mirui-dashboard-user */ "./resources/js/views/mirui-dashboard-user.js");
})();

/******/ })()
;