"use strict";

var triggerSearchNode = document.getElementById("trigger-search");
var searchForm = document.querySelector(".main-header__search__form");
if (triggerSearchNode) {
  triggerSearchNode.addEventListener("click", function () {
    var input = searchForm.querySelector("input");
    if (input && searchForm) {
      if (searchForm.style.display === "flex") {
        searchForm.style.display = "none";
        input.value = "";
      } else {
        searchForm.style.display = "flex";
      }
    }
  });
}
var giveCookiesConsentBtn = document.getElementById("give-cookies-consent");
var declineCookiesConsentBtn = document.getElementById("decline-cookies-consent");
var cookiesConsent = document.getElementById("cookies-consent");
if (cookiesConsent) {
  giveCookiesConsentBtn.addEventListener("click", function () {
    document.cookie = "ds-cookies-consent=given;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag("js", new Date());
    gtag("config", "G-4XTMS09KMT");
    cookiesConsent.remove();
  });
  declineCookiesConsentBtn.addEventListener("click", function () {
    document.cookie = "ds-cookies-consent=declined;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    cookiesConsent.remove();
  });
}
var listViewBtn = document.getElementById("list-view");
var gridViewBtn = document.getElementById("grid-view");
var archivePosts = document.getElementById("archive-posts");
if (listViewBtn && gridViewBtn) {
  listViewBtn.addEventListener("click", function () {
    document.cookie = "ds-view=list;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    gridViewBtn.classList.remove("selected");
    listViewBtn.classList.add("selected");
    if (archivePosts) {
      archivePosts.classList = "posts-list";
    }
  });
  gridViewBtn.addEventListener("click", function () {
    document.cookie = "ds-view=grid;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    listViewBtn.classList.remove("selected");
    gridViewBtn.classList.add("selected");
    if (archivePosts) {
      archivePosts.classList = "posts-grid row gx-sm-4 gx-lg-5";
    }
  });
}
var popHeader = document.getElementById("pop-header");
var triggerPopSearch = document.getElementById("trigger-pop-search");
var popSearchForm = document.getElementById("pop-header-search-form");
var input = popSearchForm.querySelector("input");
if (triggerPopSearch && popSearchForm && popHeader && input) {
  var showPopHeader = function showPopHeader() {
    var adminBar = document.getElementById("wpadminbar");
    var y = window.scrollY;
    if (adminBar) {
      popHeader.classList.add("admin-bar");
    }
    if (y >= 500) {
      popHeader.classList.add("show");
    } else {
      popHeader.classList.remove("show");
      popSearchForm.style.display = "none";
      input.value = "";
    }
  };
  window.addEventListener("scroll", showPopHeader);
  triggerPopSearch.addEventListener("click", function () {
    if (popSearchForm.style.display === "flex") {
      popSearchForm.style.display = "none";
      input.value = "";
    } else {
      popSearchForm.style.display = "flex";
    }
  });
}