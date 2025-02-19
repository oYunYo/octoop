jQuery(document).ready(function ($) {
    let currentPath = window.location.pathname;
    $(".btn-fonctionnalites a").each(function () {
        let btnID = $(this).attr("id").replace("btn-", "");
        if (currentPath.includes("/fonctionnalites/" + btnID) || currentPath.includes("/features/" + btnID)) {
            $(this).addClass("active");
        }
    });
});
