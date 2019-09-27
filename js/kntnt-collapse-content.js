jQuery( document ).ready(function( $ ) {

    $(".kntnt-collapse-content > div > div:last-child").slideUp("slow");

    $(".kntnt-collapse-content > div > div:first-child").click(function (e) {

        e.preventDefault();

        var $tab = $(this).parent();

        var is_single = $tab.parent().hasClass("single");

        $tab.toggleClass("open");
        $tab.children(":last-child").slideToggle("slow");

        if (is_single) {
            $tab.siblings().removeClass("open");
            $tab.siblings().children(":last-child").slideUp("slow");
        }

    });

});
