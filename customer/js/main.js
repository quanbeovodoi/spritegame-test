window.addEventListener("load", event => {


    // Fixed nav
 
    const nav = document.querySelector('nav'),
          mainLogo = document.querySelector('.mainLogo');
 
    window.onscroll = function () {
       if (window.pageYOffset >= 60) {
          nav.classList.add("fixed");
          mainLogo.classList.add("fixLogo");
       } else {
          nav.classList.remove("fixed");
          mainLogo.classList.remove("fixLogo");
       }
    }
 
    // search
 
    var search = document.querySelector(".search"),
    searchBox = document.querySelector(".search-box"),
    icon_search = document.querySelector(".icon_search"),
    searchTxt = document.querySelector(".search-txt");
 
 search.addEventListener("click", openSearch);
 
 function openSearch() {
    
    if (searchTxt.classList.contains('openSearch')) {
 
       searchTxt.classList.remove('openSearch');
 
       icon_search.src = "../assets/icon-search.svg";
 
       searchBox.classList.remove('addMargin');
 
       search.classList.remove('addHover');
 
    } else {
 
       searchTxt.classList.add('openSearch');
 
       icon_search.src = "../assets/icon-close.svg";
 
       searchBox.classList.add('addMargin');
 
       search.classList.add('addHover');
 
    }
 }