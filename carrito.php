<!-- Head Section Begin -->
<?php require_once('inc/layout/head.php'); ?>
<!-- Head Section End -->

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

    <?php if ( isset($_SESSION["id_user"]) ) :
        
        $pedido = new Pedidos();
        $result = $pedido->getPedidoAbierto($_SESSION["Id_Cliente"]);

        if ( $result['num_rows'] > 0 ) : ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Producto</th>
                                    <th>Nota</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $detalle = new Detalles();
                                    $results = $detalle->getDetallesPedido($result['Id_Pedido']);

                                    if ( $results->num_rows > 0 ) :
                                        while ( $product = $results->fetch_object() ) :
                                            $pedido->sumTotalCart($product->ImpTotal);
                                            require 'inc/partials/item-cart.php';
                                        endwhile;
                                    else : ?>
                                        <tr>
                                            <td colspan="5"><h3>No existen productos en el carrito</h3></td>
                                        </tr>
                                    <?php endif;

                                    $detalle->closeConnection(); 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/productos.php" class="primary-btn cart-btn">CONTINUAR COMPRANDO</a>
                        <a href="/carrito.php" class="primary-btn cart-btn cart-btn-right">
                            <span class="icon_loading"></span>
                            Actualizar Carrito
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="js-cart-message"></div>
                    <!-- <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total Pedido</h5>
                        <ul>
                            <li>Total <span>$<?php echo number_format($pedido->getTotalFinal(), 2,',','.'); ?></span></li>
                        </ul>
                        <a href="/finalizar-pedido.php" class="primary-btn">Revision Final del Pedido</a>
                    </div>
                </div>
            </div>
        </div>

    <?php $pedido->closeConnection();
        else : ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-danger text-center">No tienes ningun pedido abierto</h2>
                </div>
            </div>
        </div>
        <?php endif;
    endif; ?>

</section>
<!-- Cart Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->