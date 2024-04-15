<?php require_once('inc/layout/head.php'); ?>

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <?php require_once('inc/parts/categories.php'); ?>
            <?php require_once('inc/parts/search.php'); ?>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<?php require_once('inc/parts/breadcrumb-section.php'); ?>
<!-- Breadcrumb Section End -->

<!-- Cart Section Begin -->
<section class="shoping-cart spad">
    <?php if ( isset($_SESSION["Id_Cliente"]) ) :
        $pedido = new Pedidos();
        $result = $pedido->getPedidoAbierto($_SESSION["Id_Cliente"]);
        $result['cpanel'] = false;

        if ( !isset($_SESSION["id_user"]) ) {
            // form guest users
            require 'inc/parts/form-user-pedido.php';
        }
        // form checkout
        require ( $result['num_rows'] > 0 ) ? 'inc/parts/checkout.php' : 'inc/parts/cart-empty.php';

    endif; ?>
</section>
<!-- Cart Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->