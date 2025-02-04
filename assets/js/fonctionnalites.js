jQuery(document).ready(function ($) {
    $(".cards-web, .cards-e-reputation").hide();
    $(".cards-social").show();
    $("#btn-social").addClass("active");
    $(".btn-fonctionnalites a").click(function(e) {
        e.preventDefault(); 
        let targetClass = $(this).attr("id").replace("btn-", "cards-");
        $(".cards-web, .cards-social, .cards-e-reputation").hide();
        $("." + targetClass).fadeIn();
        $(".btn-fonctionnalites a").removeClass("active");
        $(this).addClass("active");
    });
});