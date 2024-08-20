$(document).ready(function () {
    $('.collapse')
        .on('shown.bs.collapse', function () {
            let element;
            if (this.id === 'catalogMenu') {
                element = document.getElementById("catalogCollapse");
                element.classList.remove("bi-chevron-down");
                element.classList.add("bi-chevron-up");
            } else if (this.id === 'sellersMenu') {
                element = document.getElementById("sellersCollapse");
                element.classList.remove("bi-chevron-down");
                element.classList.add("bi-chevron-up");
            }
        })
        .on('hidden.bs.collapse', function () {
            let element;
            if (this.id === 'catalogMenu') {
                element = document.getElementById("catalogCollapse");
                element.classList.remove("bi-chevron-up");
                element.classList.add("bi-chevron-down");
            } else if (this.id === 'sellersMenu') {
                element = document.getElementById("sellersCollapse");
                element.classList.remove("bi-chevron-up");
                element.classList.add("bi-chevron-down");
            }
        })

    const catalogCollapseMenu = ['/products', '/categories', '/brands', '/localizations', '/currency'];

    if (catalogCollapseMenu.includes(window.location.pathname)) {
        let icon = document.getElementById("catalogCollapse");
        icon.className = "bi bi-chevron-up icon-sidebar";
    }

    const sellersCollapseMenu = ['sellers', 'price-parse', 'prices'];

    if (sellersCollapseMenu.includes(window.location.pathname.split('/')[1])) {
        let icon = document.getElementById("sellersCollapse");
        $('#sellersMenu').collapse('show')
        icon.className = "bi bi-chevron-up icon-sidebar";
    }
});