<?php require_once('inc/layout/head.php'); ?>

<!-- Verify Auth -->
<?php if ( !isset($_SESSION["Id_Cliente"]) || $_SESSION["Id_Cliente"] == 0 || strtolower(isset($_SESSION['user']) ? $_SESSION['user'] : '') === 'poliprecios' ) {
    $host = $_SERVER['HTTP_HOST'];
    $page = 'login.php';
    $url = "http://$host/$page";
    header( "Location: $url", 401 );
    die();
} ?>
<!-- End Verify Auth -->

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<section class="cpanel container mt-5 mb-5">
    <div class="row">

        <?php require_once('inc/parts/mi-cuenta/sidebar.php'); ?>
        
        <div class="col-md-8 col-lg-9">
            <?php
                $opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 'perfil';
                switch ($opcion) {
                    case 'pedidos':
                        require_once('inc/parts/mi-cuenta/pedidos.php');
                        break;
                    default:
                        require_once('inc/parts/mi-cuenta/perfil.php');
                        break;
                }
            ?>
        </div>
    </div>
</section>

<!-- Modals -->
<?php 
    require_once('inc/parts/cpanel/modals/modal-orders.php');
?>
<!-- End Modals -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->
