<!-- Head Section Begin -->
<?php require_once('inc/layout/head.php'); ?>
<!-- Head Section End -->

<!-- Verify Admin -->
<?php if ( ! Polirubro::is_Admin()) {
    $host = $_SERVER['HTTP_HOST'];
    $page = 'index.php';
    $url = "http://$host/$page";
    header( "Location: $url", 401 );
    die();
} ?>
<!-- End Verify Admin -->

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<!-- Cart Section Begin -->
<section class="cpanel container mt-5 mb-5">
    <div class="row">

        <?php require_once('inc/parts/cpanel/sidebar.php'); ?>
        
        <div class="col-9">
            <?php
                switch ($opcion) {
                    case 'importar':
                        require_once('inc/parts/cpanel/import.php');
                        break;
                    case 'productos':
                        require_once('inc/parts/cpanel/products.php');
                        break;
                    case 'clientes':
                        require_once('inc/parts/cpanel/clients.php');
                        break;
                    case 'banners':
                        require_once('inc/parts/cpanel/banners.php');
                        break;
                    default:
                        require_once('inc/parts/cpanel/default.php');
                        break;
                }
            ?>
        </div>
    </div>
</section>
<!-- Cart Section End -->

<!-- Modals -->
<?php require_once('inc/parts/cpanel/modals/modal-clients.php'); ?>
<?php require_once('inc/parts/cpanel/modals/modal-products.php'); ?>
<?php require_once('inc/parts/cpanel/modals/modal-banners.php'); ?>
<!-- End Modals -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->