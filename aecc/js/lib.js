jQuery(function ($) {

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $(".menu-item-has-children ul.sub-menu").hide();

    $(".menu-item-has-children.current-menu-parent ul.sub-menu").show();
    $(".menu-item-has-children.current-menu-item ul.sub-menu").show();

});

jQuery( document ).ready(function($) {
    
    if ($(window).width() <= 768) {
        $("#wrapper").toggleClass("toggled");
    }

    $('.menu-item-has-children > a').hover(function () {
        $(this).siblings("ul.sub-menu").stop().slideDown();
        // $(this).siblings("ul.sub-menu").stop().slideDown("slow");
    });

    $("#media-search").keyup(function () {

        var filter = $(this).val(), count = 0;
        $(".aecc-document-body .aecc-box").each(function () {

            var current = $('.aecc-box').attr('data-name');
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });

    });

});