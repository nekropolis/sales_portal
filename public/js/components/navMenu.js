const hamBurger = document.querySelector(".toggle-btn");
hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});

$(document).ready(function () {
    const catalogCollapseMenu = ['/products', '/categories', '/brands', '/localizations', '/currency'];
    const sellersCollapseMenu = ['sellers', 'price-parse', 'prices', ];

    if (catalogCollapseMenu.includes(window.location.pathname)) {
        $('#catalogMenu').collapse('show')
    }

    if (sellersCollapseMenu.includes(window.location.pathname.split('/')[1])) {
        $('#sellersMenu').collapse('show')
    }
});
