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
            $('.item').removeClass('active');
            $('.sublist').hide();
            obj.addClass('active');
        },
        success: function (response) {
            obj.next('.sublist').show();
            obj.next('.sublist').html(response); 
        }
    });
});

/*--------------------
    Get Grupo
---------------------*/
function loadGroupCategory (subrubro) {

    event.preventDefault();

    var obj = $(this);

    var formData = new FormData();
        formData.append('action', 'getGrupoByIdSubRubro');
        formData.append('id_subrubro', subrubro);

    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('.sub-item').removeClass('active');
            $('.lastlist').hide();
            $('.'+subrubro).addClass('active');
            console.log($(this).parent().parent())
        },
        success: function (response) {
            $('.lastlist_' + subrubro).show();
            $('.lastlist_' + subrubro).html(response);
        }
    });
}

/*--------------------
    Order By Price
---------------------*/
$('#select-order-prod').on('change', function(){
    $('#form-order-prod').submit();
})

/*----------------------
    Form Login Toggle
----------------------*/
function formToggle() {
    $('.form-login').toggleClass('d-none');
}

$(document).ready( function () {
    /*--------------------
        Login Request
    ---------------------*/
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
                } else if (response == 'admin') {
                    $('.js-login-message').html('<small class="text-success">Usuario Validado, Redireccionando...</small>');
                    location.href = 'cpanel.php';
                } else if (response == 'Captcha Incorrecto!') {
                    $('.js-login-message').html('<small class="text-danger">'+response+'</small>');
                } else {
                    $('.js-login-message').html('<small class="text-danger">Usuario o contrseña Incorrecto!</small>');
                }
            }
        });
    })

    /*--------------------
        Insert Cart
    ---------------------*/
    $('.js-form-cart').submit( function (e) {

        e.preventDefault();

        var values = {};

        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
    
        var formData = new FormData();
            formData.append('action', 'insertProductCart');
            formData.append('id_product', values.id_product );
            formData.append('nota', values.nota );
            formData.append('cant', values.cant );
            formData.append('cod_product', values.cod_product);
            formData.append('name_product', values.name_product);
            formData.append('price_product', values.price_product);
    
        jQuery.ajax({
            cache: false,
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.js-login-message').html('<p>Agregando...</p>');
            },
            success: function (response) {
                if (response == 'true') {
                    $('.js-login-message').html('<small class="text-success">Agregado al carrito!</small>');
                    $("#js-dynamic-cart").load( $(location).attr("href") + ' #js-data-cart' );
                    toastr.success('Agregado al carrito!');
                } else if (response == 'exist') {
                    toastr.error('El producto ya existe en el Carrito');
                } else {
                    $('.js-login-message').html('<small class="text-danger">Ocurrio un error, por favor recarge la pagina e intente nuevamente.</small>');
                    toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    
                }
            }
        });
    })

    /*--------------------
        Update Cart
    ---------------------*/
    $('.js-form-update').submit( function (e) {

        e.preventDefault();

        var values = {};

        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
    
        var formData = new FormData();
            formData.append('action', 'updateProductCart');
            formData.append('id_item', values.id_item );
            formData.append('codprod', values.codprod );
            formData.append('cant', $('#cant_'+ values.id_item).val() );
            formData.append('nota', $('#nota_'+ values.id_item).val() );
    
        jQuery.ajax({
            cache: false,
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
                if (response == 'true') {
                    location.reload();
                } else {
                    $('.js-cart-message').html('<small class="text-danger">Ocurrio un error, por favor recarge la pagina e intente nuevamente.</small>');
                    toastr.success('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                }
            }
        });
    })

    /*--------------------
        Delete Cart
    ---------------------*/
    $('.js-form-delete').submit( function (e) {

        e.preventDefault();

        var values = {};

        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
    
        var formData = new FormData();
            formData.append('action', 'deleteProductCart');
            formData.append('id_item', values.id_item );
    
        jQuery.ajax({
            cache: false,
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 'true') {
                    location.reload();
                } else {
                    $('.js-cart-message').html('<small class="text-danger">Ocurrio un error, por favor recarge la pagina e intente nuevamente.</small>');
                    toastr.success('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                }
            }
        });
    })

    /*--------------------
        Finally Order
    ---------------------*/
    $('#js-finally-order').click( function (e) {

        e.preventDefault();

        var id_pedido = $(this).attr('data-id');
    
        var formData = new FormData();
            formData.append('action', 'finallyOrder');
            formData.append('id_pedido', id_pedido );
    
        jQuery.ajax({
            cache: false,
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 'true') {
                    //$('#js-order-message').html('<h2 class="text-success text-center">El Pedido fue enviado con exito!</h2>');
                    $("#js-dynamic-cart").load( $(location).attr("href") + ' #js-data-cart' );
                    toastr.success('El Pedido fue enviado con exito!');
                } else {
                    toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                }
            }
        });
    })

    /*--------------------------
        Update Configuration
    ----------------------------*/
    $('#form-general').submit( function(e){

        e.preventDefault();

        var values = {};
        var logo = $('#logo')[0].files;
        var banner = $('#banner')[0].files;

        $.each($(this).serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
    
        var formData = new FormData();
            formData.append('action', 'operationConfiguration');
            formData.append('logo', logo[0]);
            formData.append('banner', banner[0]);
            formData.append('email', values.email);
            formData.append('telefono', values.telefono);
            formData.append('atencion', values.atencion);
            formData.append('direccion', values.direccion);
            formData.append('whatsapp', values.whatsapp);
            formData.append('instagram', values.instagram);
            formData.append('facebook', values.facebook);
            formData.append('twitter', values.twitter);
    
        jQuery.ajax({
            cache: false,
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 'true') {
                    toastr.success('Datos Cargados Correctamente!');
                } else {
                    toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                }
            }
        });

    });

    /*--------------------
        Modals
    --------------------*/
        /*--------------------
            SET Client Data
        ---------------------*/
        $('#js-form-cli').submit( function (e) {

            e.preventDefault();

            var values = {};

            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
        
            var formData = new FormData();
                formData.append('action', 'operationClient');
                formData.append('type', values.type);
                formData.append('id', values.id);
                formData.append('name', values.name);
                formData.append('locality', values.locality);
                formData.append('mail', values.mail);
                formData.append('username', values.username);
                formData.append('password', values.password);
                formData.append('price', values.price);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            Delete Client
        ---------------------*/
        $('.js-form-cli-delete').submit( function (e) {

            e.preventDefault();

            if (!confirm("Seguro desea eliminar el cliente?")){
                return false;
            }
            
            var values = {};
            
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            $('#item_user_'+values.id_item).css('background-color','rgba(255,0,0, .5)'); // Add red background tr
        
            var formData = new FormData();
                formData.append('action', 'operationClient');
                formData.append('type', 'delete');
                formData.append('id', values.id_item);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            SET Product Data
        ---------------------*/
        $('#js-form-prod').submit( function (e) {

            e.preventDefault();

            var values = {};

            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
        
            var formData = new FormData();
                formData.append('action', 'operationProduct');
                formData.append('type_prod', values.type_prod);
                formData.append('cod_prod', values.cod_prod);
                formData.append('name_prod', values.name_prod);
                formData.append('news', values.news);
                formData.append('offer', values.offer);
                formData.append('observation', values.observation);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            Delete Product
        ---------------------*/
        $('.js-form-prod-delete').submit( function (e) {

            e.preventDefault();

            if (!confirm("Seguro desea eliminar el producto?")){
                return false;
            }
            
            var values = {};
            
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            $('#item_prod_'+ values.id_item).css('background-color','rgba(255,0,0, .5)'); // Add red background tr
        
            var formData = new FormData();
                formData.append('action', 'operationProduct');
                formData.append('type_prod', 'delete');
                formData.append('cod_prod', values.id_item);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            SET Banner Data
        ---------------------*/
        $('#js-form-banner').submit( function (e) {

            e.preventDefault();

            var values = {};
            var files = false;
            if ($('#imagePreview').val()) {
                var files = $('#imagePreview')[0].files;
            }

            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
        
            var formData = new FormData();
                formData.append('action', 'operationBanner');
                formData.append('id_banner', values.id_banner);
                formData.append('type', values.type);
                formData.append('order', values.order);
                formData.append('file', files[0]);
                formData.append('title', values.title);
                formData.append('text', values.text);
                formData.append('link', values.link);
                formData.append('small', values.small);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            Delete Banner
        ---------------------*/
        $('.js-form-banner-delete').submit( function (e) {

            e.preventDefault();

            if (!confirm("Seguro desea eliminar el banner?")){
                return false;
            }
            
            var values = {};
            
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            $('#item_banner_'+ values.id_item).css('background-color','rgba(255,0,0, .5)'); // Add red background tr
        
            var formData = new FormData();
                formData.append('action', 'operationBanner');
                formData.append('type', 'delete');
                formData.append('id_banner', values.id_item);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            SET Categ Data
        ---------------------*/
        $('#js-form-categ').submit( function (e) {

            e.preventDefault();

            var values = {};
            var files = false;
            if ($('#imagePreviewCateg').val()) {
                var files = $('#imagePreviewCateg')[0].files;
            }

            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
        
            var formData = new FormData();
                formData.append('action', 'operationCateg');
                formData.append('id_categ', values.id_categ);
                formData.append('type', values.type);
                formData.append('order', values.order);
                formData.append('file', files[0]);
                formData.append('title', values.title);
                //formData.append('color', values.color);
                formData.append('link', values.link);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })

        /*--------------------
            Delete Categ
        ---------------------*/
        $('.js-form-categ-delete').submit( function (e) {

            e.preventDefault();

            if (!confirm("Seguro desea eliminar la categoria?")){
                return false;
            }
            
            var values = {};
            
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            $('#item_categ_'+ values.id_item).css('background-color','rgba(255,0,0, .5)'); // Add red background tr
        
            var formData = new FormData();
                formData.append('action', 'operationCateg');
                formData.append('type', 'delete');
                formData.append('id_categ', values.id_item);
        
            jQuery.ajax({
                cache: false,
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == 'true') {
                        location.reload();
                    } else {
                        toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
                    }
                }
            });
        })
});

/*-----------------------
    Show Preview Image
-----------------------*/
$("#imagePreview").change(function(e) {
    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        var file = e.originalEvent.srcElement.files[i];
        var img = document.getElementById("preview-img");
        var reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        }
        reader.readAsDataURL(file);
    }
});

$("#imagePreviewCateg").change(function(e) {
    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        var file = e.originalEvent.srcElement.files[i];
        var img = document.getElementById("preview-img-categ");
        var reader = new FileReader();
        reader.onloadend = function() {
            img.src = reader.result;
        }
        reader.readAsDataURL(file);
    }
});

/*----------------------
    Clean Client Modal
----------------------*/
function cleanModal() {

    $.each($('#js-form-cli').serializeArray(), function(i, field) {
        $('#'+field.name).val('');
    });

    $('#id_cli').val('');
    $('#pass_cli').val('');
    $('#type_cli').val('new');
}

/*--------------------
    Clean Prod Modal
--------------------*/
function cleanProdModal() {
    $.each($('#js-form-prod').serializeArray(), function(i, field) {
        $('#'+field.name).val('');
    });
}

/*----------------------
    Clean Banner Modal
----------------------*/
function cleanBannerModal() {
    $.each($('#js-form-banner').serializeArray(), function(i, field) {
        $('#'+field.name).val('');
    });
}

/*----------------------
    Clean Categ Modal
----------------------*/
function cleanCategModal() {
    $.each($('#js-form-categ').serializeArray(), function(i, field) {
        $('#'+field.name).val('');
    });
}

/*--------------------
    GET Client Data
--------------------*/
function getClientdata(obj) {
    var id_client = $(obj).attr('data-cli');
    var data;

    cleanModal();

    var formData = new FormData();
        formData.append('action', 'dataClient');
        formData.append('id_client', id_client );
    
    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 'false' || response == 'undefines') {
                toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
            } else {
                data = JSON.parse(response);         
                $('#id_cli').val(data.Id_Cliente);
                $('#type_cli').val('edit');
                $('#name').val(data.Nombre);
                $('#locality').val(data.Localidad);
                $('#mail').val(data.Mail);
                $('#username').val(data.Usuario);
                $('#pass_cli').val(data.Password);
                $('#price').val(data.ListaPrecioDef);
            }
        }
    });
}

/*--------------------
    GET Product Data
--------------------*/
function getProddata(obj) {
    var cod_product = $(obj).attr('data-prod');
    var data;

    cleanProdModal();

    var formData = new FormData();
        formData.append('action', 'dataProduct');
        formData.append('cod_product', cod_product );
    
    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 'false' || response == 'undefines') {
                toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
            } else {
                data = JSON.parse(response); 
                $('#cod_prod').val(data.cod_producto);
                $('#type_prod').val('edit');
                $('#name_prod').val(data.nombre);
                $('#observation').val(data.observaciones);
            }
        }
    });
}

/*--------------------
    GET Banner Data
--------------------*/
function getBannerdata(obj) {
    var id_banner = $(obj).attr('data-ban');
    var data;

    cleanBannerModal();

    var formData = new FormData();
        formData.append('action', 'dataBanner');
        formData.append('id_banner', id_banner );
    
    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 'false' || response == 'undefines') {
                toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
            } else {
                data = JSON.parse(response);         
                $('#type_ban').val('edit');
                $('#id_banner').val(data.Id_banner);
                $('#order').val(data.orden);
                $('#title').val(data.title);
                $('#text').val(data.text);
                $('#link').val(data.link);
                $('#small').val(data.small);

                var img = document.getElementById("preview-img");
                img.src = data.image;
            }
        }
    });
}

/*--------------------
    GET Categ Data
--------------------*/
function getCategdata(obj) {
    var id_categ = $(obj).attr('data-categ');
    var data;

    cleanCategModal();

    var formData = new FormData();
        formData.append('action', 'dataCateg');
        formData.append('id_categ', id_categ );
    
    jQuery.ajax({
        cache: false,
        url: 'inc/functions/ajax-requests.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 'false' || response == 'undefines') {
                toastr.error('Ocurrio un error, por favor recarge la pagina e intente nuevamente.');
            } else {
                data = JSON.parse(response);         
                $('#type_categ').val('edit');
                $('#id_categ').val(data.id_categ);
                $('#order_categ').val(data.order);
                $('#title_categ').val(data.title);
                //$('#color').val(data.color);
                $('#link_categ').val(data.link);

                var img = document.getElementById("preview-img-categ");
                img.src = data.icon;
            }
        }
    });
}