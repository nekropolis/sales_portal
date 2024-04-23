$(document).ready(function () {
    $('.collapse')
        .on('shown.bs.collapse', function () {
            $(this)
                .parent()
                .find(".bi-chevron-down")
                .removeClass("bi-chevron-down")
                .addClass("bi-chevron-up");
        })
        .on('hidden.bs.collapse', function () {
            $(this)
                .parent()
                .find(".bi-chevron-up")
                .removeClass("bi-chevron-up")
                .addClass("bi-chevron-down");
        })

    const collapseMenu = ['/products', '/categories', '/brands', '/margin', '/currency'];

    if (collapseMenu.includes(window.location.pathname)) {
        let icon = document.getElementById("catalogCollapse");

        icon.className = "bi bi-chevron-up";
    }
});