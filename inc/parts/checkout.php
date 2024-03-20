<!-- ======================================
    Reusable Module
    # Admin (Modal Orders)
    # User Checkout Page
===================================== -->
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
                                    require ($result['cpanel']) ? '../../inc/partials/item-pedido.php' : 'inc/partials/item-pedido.php';
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
                 <!-- Danger Bootstrap -->
                 <?php if ($pedido->getTotalFinal() < $general->getMinimo()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-circle"></i> El minimo de compra para cerrar el pedido es de <strong>$<?php echo number_format($general->getMinimo(), 0,'','.'); ?></strong>
                    </div>
                <?php endif; ?>
                <!-- Final Order -->
                <?php if (!$result['cpanel'] && $pedido->getTotalFinal() >= $general->getMinimo()) : ?>
                    <a href="#" id="js-finally-order" data-id="<?php echo $result['Id_Pedido']; ?>" class="primary-btn">Finalizar Pedido</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>