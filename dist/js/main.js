"use strict";function loadGroupCategory(a){event.preventDefault();$(this);var e=new FormData;e.append("action","getGrupoByIdSubRubro"),e.append("id_subrubro",a),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,beforeSend:function(){$(".sub-item").removeClass("active"),$(".lastlist").hide(),$("."+a).addClass("active"),console.log($(this).parent().parent())},success:function(e){$(".lastlist_"+a).show(),$(".lastlist_"+a).html(e)}})}function formToggle(){$(".form-login").toggleClass("d-none")}function cleanModal(){$.each($("#js-form-cli").serializeArray(),function(e,a){$("#"+a.name).val("")}),$("#id_cli").val(""),$("#pass_cli").val(""),$("#type_cli").val("new")}function cleanProdModal(){$.each($("#js-form-prod").serializeArray(),function(e,a){$("#"+a.name).val("")})}function cleanBannerModal(){$.each($("#js-form-banner").serializeArray(),function(e,a){$("#"+a.name).val("")})}function cleanCategModal(){$.each($("#js-form-categ").serializeArray(),function(e,a){$("#"+a.name).val("")})}function getClientdata(e){var a,e=$(e).attr("data-cli"),t=(cleanModal(),new FormData);t.append("action","dataClient"),t.append("id_client",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,success:function(e){"false"==e||"undefines"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):(a=JSON.parse(e),$("#id_cli").val(a.Id_Cliente),$("#type_cli").val("edit"),$("#name").val(a.Nombre),$("#locality").val(a.Localidad),$("#mail").val(a.Mail),$("#username").val(a.Usuario),$("#pass_cli").val(a.Password),$("#price").val(a.ListaPrecioDef))}})}function getProddata(e){var a,e=$(e).attr("data-prod"),t=(cleanProdModal(),new FormData);t.append("action","dataProduct"),t.append("cod_product",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,success:function(e){"false"==e||"undefines"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):(a=JSON.parse(e),$("#cod_prod").val(a.cod_producto),$("#type_prod").val("edit"),$("#name_prod").val(a.nombre),$("#observation").val(a.observaciones))}})}function getBannerdata(e){var a,e=$(e).attr("data-ban"),t=(cleanBannerModal(),new FormData);t.append("action","dataBanner"),t.append("id_banner",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,success:function(e){"false"==e||"undefines"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):(a=JSON.parse(e),$("#type_ban").val("edit"),$("#id_banner").val(a.Id_banner),$("#order").val(a.orden),$("#title").val(a.title),$("#text").val(a.text),$("#link").val(a.link),$("#small").val(a.small),document.getElementById("preview-img").src=a.image)}})}function getCategdata(e){var a,e=$(e).attr("data-categ"),t=(cleanCategModal(),new FormData);t.append("action","dataCateg"),t.append("id_categ",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,success:function(e){"false"==e||"undefines"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):(a=JSON.parse(e),$("#type_categ").val("edit"),$("#id_categ").val(a.id_categ),$("#order_categ").val(a.order),$("#title_categ").val(a.title),$("#link_categ").val(a.link),document.getElementById("preview-img-categ").src=a.icon)}})}function updateCart(e){var a=new FormData;a.append("action","updateCart"),a.append("Id_Pedido",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:a,contentType:!1,processData:!1,success:function(e){"false"==e||"undefined"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):(e=JSON.parse(e),toastr.success("Pedido Actualizado Correctamente."),0<e.updated&&toastr.info(e.updated+" Productos Actualizados"),0<e.deleted&&toastr.info(e.deleted+" Productos Eliminados"),setTimeout(function(){location.reload()},3e3))}})}function getOrderData(e){var e=$(e).attr("data-order"),a=document.getElementById("contentOrderDetail"),t=(a.innerHTML="",new FormData);t.append("action","dataOrders"),t.append("Id_Pedido",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,success:function(e){"false"==e||"undefines"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):a.innerHTML=e}})}function sendContact(){event.preventDefault();for(var e=["name","email","state","locality","address","phone","message"],a=0;a<e.length;a++){if(""==$("#"+e[a]).val())return $("#control_"+e[a]).html('<p class="text-danger">Completa este campo</p>'),toastr.error("Todos los campos son obligatorios."),!1;$("#control_"+e[a]).html("")}var t=new FormData;t.append("action","sendContact"),t.append("name",$("#name").val()),t.append("email",$("#email").val()),t.append("state",$("#state").val()),t.append("locality",$("#locality").val()),t.append("address",$("#address").val()),t.append("phone",$("#phone").val()),t.append("message",$("#message").val()),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,success:function(e){"false"==e||"undefined"==e?toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."):(toastr.success("Mensaje Enviado Correctamente."),$("#js-contact-form")[0].reset())}})}function deleteRow(e){e=e.parentNode.parentNode;e.parentNode.removeChild(e)}!function(t){t(window).on("load",function(){var e;t(".loader").fadeOut(),t("#preloder").delay(200).fadeOut("slow"),t(".featured__controls li").on("click",function(){t(".featured__controls li").removeClass("active"),t(this).addClass("active")}),0<t(".featured__filter").length&&(e=document.querySelector(".featured__filter"),mixitup(e))}),t(".set-bg").each(function(){var e=t(this).data("setbg");t(this).css("background-image","url("+e+")")}),t(".humberger__open").on("click",function(){t(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper"),t(".humberger__menu__overlay").addClass("active"),t("body").addClass("over_hid")}),t(".humberger__menu__overlay").on("click",function(){t(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper"),t(".humberger__menu__overlay").removeClass("active"),t("body").removeClass("over_hid")}),t(".mobile-menu").slicknav({prependTo:"#mobile-menu-wrap",allowParentLinks:!0}),t(".categories__slider").owlCarousel({loop:!0,margin:0,items:4,dots:!1,nav:!0,navText:["<span class='fa fa-angle-left'><span/>","<span class='fa fa-angle-right'><span/>"],animateOut:"fadeOut",animateIn:"fadeIn",smartSpeed:1200,autoHeight:!1,autoplay:!0,responsive:{0:{items:1},480:{items:2},768:{items:3},992:{items:4}}}),t(".hero__categories__all").on("click",function(){t(".hero__categories ul").slideToggle(400)}),t(".latest-product__slider").owlCarousel({loop:!0,margin:0,items:1,dots:!1,nav:!0,navText:["<span class='fa fa-angle-left'><span/>","<span class='fa fa-angle-right'><span/>"],smartSpeed:1200,autoHeight:!1,autoplay:!0}),t(".product__discount__slider").owlCarousel({loop:!0,margin:0,items:3,dots:!0,smartSpeed:1200,autoHeight:!1,autoplay:!0,responsive:{320:{items:1},480:{items:2},768:{items:2},992:{items:3}}}),t(".product__details__pic__slider").owlCarousel({loop:!0,margin:20,items:4,dots:!0,smartSpeed:1200,autoHeight:!1,autoplay:!0});var e=t(".price-range"),n=t("#minamount"),r=t("#maxamount"),a=e.data("min"),o=e.data("max"),a=(e.slider({range:!0,min:a,max:o,values:[a,o],slide:function(e,a){n.val("$"+a.values[0]),r.val("$"+a.values[1])}}),n.val("$"+e.slider("values",0)),r.val("$"+e.slider("values",1)),t("select").niceSelect(),t(".product__details__pic__slider img").on("click",function(){var e=t(this).data("imgbigurl");e!=t(".product__details__pic__item--large").attr("src")&&t(".product__details__pic__item--large").attr({src:e})}),t(".pro-qty"));a.prepend('<span class="dec qtybtn">-</span>'),a.append('<span class="inc qtybtn">+</span>'),a.on("click",".qtybtn",function(){var e=t(this),a=e.parent().find("input").val();a=e.hasClass("inc")?parseFloat(a)+1:0<a?parseFloat(a)-1:0,e.parent().find("input").val(a)})}(jQuery),$(".owl-banner-carousel").owlCarousel({loop:!0,margin:0,items:1,dots:!0,nav:!1,navText:!1,smartSpeed:1200,autoHeight:!0,autoplay:!0}),$(".sublistCTA span").on("click",function(e){e.preventDefault(),$(this).parent().next(".sublist").slideToggle(400)}),$(".lastlistCTA span").on("click",function(e){e.preventDefault(),$(this).parent().next(".lastlist").slideToggle(400)}),$(".sublistCTA").on("click",function(){var a=$(this),e=a.attr("data-rubro"),t=new FormData;t.append("action","getSubRubroByIdRubro"),t.append("id_rubro",e),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:t,contentType:!1,processData:!1,beforeSend:function(){$(".item").removeClass("active"),$(".sublist").hide(),a.addClass("active")},success:function(e){a.next(".sublist").show(),a.next(".sublist").html(e)}})}),$("#select-order-prod").on("change",function(){$("#form-order-prod").submit()}),$(document).ready(function(){$(".form-login").submit(function(e){e.preventDefault();var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),""==t.user&&$(".js-login-message").html("<p>Ingrese Usuario</p>"),""==t.pass&&$(".js-login-message").html("<p>Ingrese Contraseña</p>"),""==t["g-recaptcha-response"]&&$(".js-login-message").html("<p>Complete Captcha</p>"),new FormData);e.append("action","actionLogin"),e.append("user",t.user),e.append("pass",t.pass),e.append("g-recaptcha-response",t["g-recaptcha-response"]),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,beforeSend:function(){$(".js-login-message").html("<p>Validando...</p>")},success:function(e){var a=JSON.parse(e);toastr.success("Pedido Actualizado Correctamente."),0<a.updated.updated&&toastr.info(a.updated.updated+" Productos Actualizados"),0<a.updated.deleted&&toastr.info(a.updated.deleted+" Productos Eliminados"),setTimeout(function(){"true"==a.login?($(".js-login-message").html('<small class="text-success">Usuario Validado, Redireccionando...</small>'),location.reload()):"admin"==a.login?($(".js-login-message").html('<small class="text-success">Usuario Validado, Redireccionando...</small>'),location.href="cpanel.php"):"Captcha Incorrecto!"==a.login?$(".js-login-message").html('<small class="text-danger">'+a.login+"</small>"):$(".js-login-message").html('<small class="text-danger">Usuario o contrseña Incorrecto!</small>')},3e3)}})}),$(".js-form-cart").submit(function(e){e.preventDefault();var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);e.append("action","insertProductCart"),e.append("id_product",t.id_product),e.append("nota",t.nota),e.append("cant",t.cant),e.append("cod_product",t.cod_product),e.append("name_product",t.name_product),e.append("price_product",t.price_product),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,beforeSend:function(){$(".js-login-message").html("<p>Agregando...</p>")},success:function(e){"true"==e?($(".js-login-message").html('<small class="text-success">Agregado al carrito!</small>'),$("#js-dynamic-cart").load($(location).attr("href")+" #js-data-cart"),toastr.success("Agregado al carrito!")):"exist"==e?toastr.error("El producto ya existe en el Carrito"):($(".js-login-message").html('<small class="text-danger">Ocurrio un error, por favor recarge la pagina e intente nuevamente.</small>'),toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."))}})}),$(".js-form-update").submit(function(e){e.preventDefault();var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);e.append("action","updateProductCart"),e.append("id_item",t.id_item),e.append("codprod",t.codprod),e.append("cant",$("#cant_"+t.id_item).val()),e.append("nota",$("#nota_"+t.id_item).val()),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){console.log(e),"true"==e?location.reload():($(".js-cart-message").html('<small class="text-danger">Ocurrio un error, por favor recarge la pagina e intente nuevamente.</small>'),toastr.success("Ocurrio un error, por favor recarge la pagina e intente nuevamente."))}})}),$(".js-form-delete").submit(function(e){e.preventDefault();var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);e.append("action","deleteProductCart"),e.append("id_item",t.id_item),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():($(".js-cart-message").html('<small class="text-danger">Ocurrio un error, por favor recarge la pagina e intente nuevamente.</small>'),toastr.success("Ocurrio un error, por favor recarge la pagina e intente nuevamente."))}})}),$("#js-finally-order").click(function(e){e.preventDefault();var a={};const t=document.querySelectorAll('input[type="hidden"]');for(let e=0;e<t.length;e++)a[t[e].name]=t[e].value;if(e=document.getElementById("js-form-user-pedido")){const t=e.querySelectorAll("input, select, textarea");for(let e=0;e<t.length;e++)a[t[e].name]=t[e].value}var e=$(this).attr("data-id"),n=new FormData;n.append("action","finallyOrder"),n.append("id_pedido",e),n.append("data",JSON.stringify(a)),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:n,contentType:!1,processData:!1,beforeSend:function(){$("#js-finally-order").html("ENVIANDO...")},success:function(e){"true"==e?($("#js-finally-order").html("PEDIDO ENVIADO"),$("#js-dynamic-cart").load($(location).attr("href")+" #js-data-cart"),toastr.success("El Pedido fue enviado con exito!"),setTimeout(function(){window.location.href="index.php"},3e3)):($("#js-finally-order").html("FINALIZAR PEDIDO"),toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente."))}})}),$(".js-finally-order-admin").click(function(e){e.preventDefault();var a={},t=$(this).attr("data-ord"),n=document.querySelector(".shoping__checkout").querySelectorAll('input[type="hidden"]');for(let e=0;e<n.length;e++)a[n[e].name]=n[e].value;e=new FormData;e.append("action","finallyOrderAdmin"),e.append("id_pedido",t),e.append("data",JSON.stringify(a)),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?($("#item_order_"+t).css("background-color","rgba(#7fad39, .5)"),toastr.success("El Pedido finalizado!"),location.reload()):toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$("#form-general").submit(function(e){e.preventDefault();var t={},e=$("#logo")[0].files,a=$("#banner")[0].files,n=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),[{}]),r=document.getElementsByName("precio[]"),o=document.getElementsByName("descuento[]");for(let e=0;e<r.length;e++){var i=r[e],s=o[e];""!=i.value&&""!=s.value&&(n[e]={precio:i.value,descuento:s.value})}var c=new FormData;c.append("action","operationConfiguration"),c.append("logo",e[0]),c.append("banner",a[0]),c.append("email",t.email),c.append("telefono",t.telefono),c.append("atencion",t.atencion),c.append("direccion",t.direccion),c.append("whatsapp",t.whatsapp),c.append("instagram",t.instagram),c.append("facebook",t.facebook),c.append("twitter",t.twitter),c.append("aumento_1",t.aumento_1),c.append("minimo",t.minimo),c.append("descuentos",JSON.stringify(n)),console.log(JSON.stringify(n)),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:c,contentType:!1,processData:!1,success:function(e){"true"==e?toastr.success("Datos Cargados Correctamente!"):toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$("#js-form-cli").submit(function(e){e.preventDefault();var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);e.append("action","operationClient"),e.append("type",t.type),e.append("id",t.id),e.append("name",t.name),e.append("locality",t.locality),e.append("mail",t.mail),e.append("username",t.username),e.append("password",t.password),e.append("price",t.price),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$(".js-form-cli-delete").submit(function(e){if(e.preventDefault(),!confirm("Seguro desea eliminar el cliente?"))return!1;var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),$("#item_user_"+t.id_item).css("background-color","rgba(255,0,0, .5)"),new FormData);e.append("action","operationClient"),e.append("type","delete"),e.append("id",t.id_item),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$("#js-form-prod").submit(function(e){e.preventDefault();var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);e.append("action","operationProduct"),e.append("type_prod",t.type_prod),e.append("cod_prod",t.cod_prod),e.append("name_prod",t.name_prod),e.append("news",t.news),e.append("offer",t.offer),e.append("observation",t.observation),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$(".js-form-prod-delete").submit(function(e){if(e.preventDefault(),!confirm("Seguro desea eliminar el producto?"))return!1;var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),$("#item_prod_"+t.id_item).css("background-color","rgba(255,0,0, .5)"),new FormData);e.append("action","operationProduct"),e.append("type_prod","delete"),e.append("cod_prod",t.id_item),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$("#js-form-banner").submit(function(e){e.preventDefault();var t={},e=!1,a=($("#imagePreview").val()&&(e=$("#imagePreview")[0].files),$.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);a.append("action","operationBanner"),a.append("id_banner",t.id_banner),a.append("type",t.type),a.append("order",t.order),a.append("file",e[0]),a.append("title",t.title),a.append("text",t.text),a.append("link",t.link),a.append("small",t.small),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:a,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$(".js-form-banner-delete").submit(function(e){if(e.preventDefault(),!confirm("Seguro desea eliminar el banner?"))return!1;var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),$("#item_banner_"+t.id_item).css("background-color","rgba(255,0,0, .5)"),new FormData);e.append("action","operationBanner"),e.append("type","delete"),e.append("id_banner",t.id_item),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$("#js-form-categ").submit(function(e){e.preventDefault();var t={},e=!1,a=($("#imagePreviewCateg").val()&&(e=$("#imagePreviewCateg")[0].files),$.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),new FormData);a.append("action","operationCateg"),a.append("id_categ",t.id_categ),a.append("type",t.type),a.append("order",t.order),a.append("file",e[0]),a.append("title",t.title),a.append("link",t.link),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:a,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$(".js-form-categ-delete").submit(function(e){if(e.preventDefault(),!confirm("Seguro desea eliminar la categoria?"))return!1;var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),$("#item_categ_"+t.id_item).css("background-color","rgba(255,0,0, .5)"),new FormData);e.append("action","operationCateg"),e.append("type","delete"),e.append("id_categ",t.id_item),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})}),$(".js-form-order-delete").submit(function(e){if(e.preventDefault(),!confirm("Seguro desea eliminar el pedido?"))return!1;var t={},e=($.each($(this).serializeArray(),function(e,a){t[a.name]=a.value}),$("#item_order_"+t.id_item).css("background-color","rgba(255,0,0, .5)"),new FormData);e.append("action","deleteOrderAdmin"),e.append("Id_Pedido",t.id_item),jQuery.ajax({cache:!1,url:"inc/functions/ajax-requests.php",type:"POST",data:e,contentType:!1,processData:!1,success:function(e){"true"==e?location.reload():toastr.error("Ocurrio un error, por favor recarge la pagina e intente nuevamente.")}})})}),$("#imagePreview").change(function(e){for(var a=0;a<e.originalEvent.srcElement.files.length;a++){var t=e.originalEvent.srcElement.files[a],n=document.getElementById("preview-img"),r=new FileReader;r.onloadend=function(){n.src=r.result},r.readAsDataURL(t)}}),$("#imagePreviewCateg").change(function(e){for(var a=0;a<e.originalEvent.srcElement.files.length;a++){var t=e.originalEvent.srcElement.files[a],n=document.getElementById("preview-img-categ"),r=new FileReader;r.onloadend=function(){n.src=r.result},r.readAsDataURL(t)}}),$("#js-contact-form").submit(sendContact),function(){const n=document.getElementById("js-table-descuentos");var e=document.getElementById("js-add-row");n&&e&&e.addEventListener("click",()=>{var e=n.querySelector("tbody").insertRow(),a=e.insertCell(),t=e.insertCell(),e=e.insertCell();a.innerHTML='<input type="number" name="precio[]" class="form-control">',t.innerHTML='<input type="number" name="descuento[]" class="form-control">',e.innerHTML='<button type="button" class="btn btn-danger" onclick="deleteRow(this)">Eliminar</button>'})}(jQuery);
//# sourceMappingURL=main.js.map
