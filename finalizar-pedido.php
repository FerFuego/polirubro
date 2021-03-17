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

    <?php  if ( isset($_SESSION["id_user"]) ) :
        
        $pedido = new Pedidos();
        $result = $pedido->getPedidoAbierto($_SESSION["Id_Cliente"]);

        if ( $result['num_rows'] > 0 ) : ?>

        <div class="container" id="js-order-message">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $detalle = new Detalles();
                                    $results = $detalle->getDetallesPedido($result['Id_Pedido']);

                                    if ( $results->num_rows > 0 ) :
                                        while ( $product = $results->fetch_object() ) :
                                            $pedido->sumTotalCart($product->ImpTotal);
                                            require 'inc/partials/item-pedido.php';
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
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <div class="shoping__checkout mt-0">
                        <h5>Total Pedido</h5>
                        <ul>
                            <li>Total <span>$<?php echo number_format($pedido->getTotalFinal(), 2,',','.'); ?></span></li>
                        </ul>
                        <a href="#" id="js-finally-order" data-id="<?php echo $result['Id_Pedido']; ?>" class="primary-btn">Finalizar Pedido</a>
                    </div>
                </div>
            </div>
        </div>

    <?php $pedido->closeConnection();
        endif;
    endif; ?>

</section>
<!-- Cart Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->