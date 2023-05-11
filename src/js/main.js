const triggerSearchNode = document.getElementById("trigger-search");
const searchForm = document.querySelector(".main-header__search__form");

if (triggerSearchNode) {
  triggerSearchNode.addEventListener("click", () => {
    const input = searchForm.querySelector("input");

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

const giveCookiesConsentBtn = document.getElementById("give-cookies-consent");
const declineCookiesConsentBtn = document.getElementById(
  "decline-cookies-consent"
);
const cookiesConsent = document.getElementById("cookies-consent");

if (cookiesConsent) {
  giveCookiesConsentBtn.addEventListener("click", () => {
    document.cookie =
      "ds-cookies-consent=given;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";

    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-4XTMS09KMT");

    cookiesConsent.remove();
  });

  declineCookiesConsentBtn.addEventListener("click", () => {
    document.cookie =
      "ds-cookies-consent=declined;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    cookiesConsent.remove();
  });
}

const listViewBtn = document.getElementById("list-view");
const gridViewBtn = document.getElementById("grid-view");
const archivePosts = document.getElementById("archive-posts");

if (listViewBtn && gridViewBtn) {
  listViewBtn.addEventListener("click", () => {
    document.cookie =
      "ds-view=list;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    gridViewBtn.classList.remove("selected");
    listViewBtn.classList.add("selected");

    if (archivePosts) {
      archivePosts.classList = "posts-list";
    }
  });

  gridViewBtn.addEventListener("click", () => {
    document.cookie =
      "ds-view=grid;path=/;expires=Thu, 11 Feb 2297 13:54:13 GMT";
    listViewBtn.classList.remove("selected");
    gridViewBtn.classList.add("selected");

    if (archivePosts) {
      archivePosts.classList = "posts-grid row gx-sm-4 gx-lg-5";
    }
  });
}

const popHeader = document.getElementById("pop-header");
const triggerPopSearch = document.getElementById("trigger-pop-search");
const popSearchForm = document.getElementById("pop-header-search-form");
const input = popSearchForm.querySelector("input");

if (triggerPopSearch && popSearchForm && popHeader && input) {
  const showPopHeader = () => {
    const adminBar = document.getElementById("wpadminbar");
    let y = window.scrollY;

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

  triggerPopSearch.addEventListener("click", () => {
    if (popSearchForm.style.display === "flex") {
      popSearchForm.style.display = "none";
      input.value = "";
    } else {
      popSearchForm.style.display = "flex";
    }
  });
}
