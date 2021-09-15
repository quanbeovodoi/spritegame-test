
// search

var searchBox = document.querySelector(".search-box"),
iconSearch = document.querySelector(".icon-search"),
icon_Search = document.querySelector(".icon_search"),
searchTxt = document.querySelector(".search-txt");

iconSearch.addEventListener("click", openSearch);

function openSearch() {
    
    if (searchBox.classList.contains('openSearch')) {

        

        searchTxt.classList.remove('openSearch');

        icon_Search.classList.remove('openSearch');

        icon_Search.src = "../assets/icon-search.svg";

        setTimeout(function () {

        searchBox.classList.remove('openSearch');
        iconSearch.classList.remove('openSearch');
        }, 150);

    } else {

        searchBox.classList.add('openSearch');

        iconSearch.classList.add('openSearch');

        searchTxt.classList.add('openSearch');

        icon_Search.classList.add('openSearch');

        icon_Search.src = "../assets/icon-close.svg";

    }
}