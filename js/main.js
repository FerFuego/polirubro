'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            }
        }
    });


    $('.hero__categories__all').on('click', function(){
        $('.hero__categories ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
		Price Range Slider
	------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('$' + ui.values[0]);
            maxamount.val('$' + ui.values[1]);
        }
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
		Single Product
	--------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

})(jQuery);

/*-------------------
    Hero Slider
--------------------- */
$('.owl-banner-carousel').owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    dots: true,
    nav: false,
    navText: false,
    smartSpeed: 1200,
    autoHeight: true,
    autoplay: true
});

/*--------------------------
    CTA categories tree
----------------------------*/
$('.sublistCTA span').on('click', function(e){
    e.preventDefault();
    $(this).parent().next('.sublist').slideToggle(400);
});

/*--------------------------
    CTA categories tree
----------------------------*/
$('.lastlistCTA span').on('click', function(e){
    e.preventDefault();
    $(this).parent().next('.lastlist').slideToggle(400);
});

/*-------------------
    Get SubRubros
--------------------- */
$('.sublistCTA').on('click', function () {

    var obj = $(this);
    var id_rubro = obj.attr('data-rubro');

    var formData = new FormData();
        formData.append('action', 'getSubRubroByIdRubro');
        formData.append('id_rubro', id_rubro);

    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            //
        },
        success: function (response) {
            obj.next('.sublist').html(response);
        }
    });
});

/*--------------------
    Get Grupo
---------------------*/
$('.lastlistCTA').on('click', function () {

    var obj = $(this);
    var id_subrubro = obj.attr('data-subrubro');

    var formData = new FormData();
        formData.append('action', 'getGrupoByIdSubRubro');
        formData.append('id_subrubro', id_subrubro);

    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            //
        },
        success: function (response) {
            obj.next('.lastlist').html(response);
        }
    });
})

/*----------------------
    Form Login Toggle
----------------------*/
function formToggle() {
    $('.form-login').toggleClass('d-none');
}

/*--------------------
    Login Request
---------------------*/
$(document).ready( function () {
    $('.form-login').submit( function (e) {

        e.preventDefault();

        var values = {};

        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
    
        if (values.user == '') {
            $('.js-login-message').html('<p>Ingrese Usuario</p>');
        }
    
        if (values.pass == '') {
            $('.js-login-message').html('<p>Ingrese Contraseña</p>');
        }

        if (values['g-recaptcha-response'] == '') {
            $('.js-login-message').html('<p>Complete Captcha</p>');
        }
    
        var formData = new FormData();
            formData.append('action', 'actionLogin');
            formData.append('user', values.user );
            formData.append('pass', values.pass );
            formData.append('g-recaptcha-response', values['g-recaptcha-response'] );
    
        jQuery.ajax({
            cache: false,
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.js-login-message').html('<p>Validando...</p>');
            },
            success: function (response) {
                if (response == 'true') {
                    $('.js-login-message').html('<small class="text-success">Usuario Validado, Redireccionando...</small>');
                    location.reload();
                } else if (response == 'Captcha Incorrecto!') {
                    $('.js-login-message').html('<small class="text-danger">'+response+'</small>');
                } else {
                    $('.js-login-message').html('<small class="text-danger">Usuario o contrseña Incorrecto!</small>');
                }
            }
        });
    })
});