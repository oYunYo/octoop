jQuery(document).ready(function ($) {
    function isMobile() {
        return $(window).width() <= 768; 
    }

    function updatePricingDisplay() {
        if (isMobile()) {
            $(".tarif-box").hide();
            $(".tarif-mensuel").show(); 
        } else {
            $(".tarif-mensuel").removeClass("inactive").addClass("active").show();
            $(".tarif-annuel").removeClass("active").addClass("inactive").show();
        }
    }

    updatePricingDisplay();

    $(".tarif-btn a").click(function(e) {
        e.preventDefault(); 
        $(".tarif-btn").removeClass("active");
        $(this).closest(".tarif-btn").addClass("active");

        if (isMobile()) {
            $(".tarif-box").hide();
            if ($(this).attr("id") === "btn-mensuel") {
                $(".tarif-mensuel").fadeIn();
            } else {
                $(".tarif-annuel").fadeIn();
            }
        } else {
            if ($(this).attr("id") === "btn-mensuel") {
                $(".tarif-mensuel").removeClass("inactive").addClass("active");
                $(".tarif-annuel").removeClass("active").addClass("inactive");
            } else {
                $(".tarif-annuel").removeClass("inactive").addClass("active");
                $(".tarif-mensuel").removeClass("active").addClass("inactive");
            }
        }
    });
    // Si l'utilisateur redimensionne l'écran
    $(window).resize(function() {
        updatePricingDisplay();
    });
});