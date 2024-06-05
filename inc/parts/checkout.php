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
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="shoping__continue">
                <?php
                $general = new Configuracion();
                $data = json_decode($general->getDescuentos(), true);
                if (!empty($data[0]) && !isset($_SESSION['user'])): ?>
                    <div class="shoping__discount shoping__checkout mt-0">
                        <h5>Tabla de Descuentos</h5>
                        <table class="table table-bordered">
                            <thead>
                                <th>Descuento</th>
                                <th>&nbsp;&nbsp;Compras</th>
                            </thead>
                            <?php foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['descuento'] . "%"; ?></td>
                                    <td>> $<?php echo  number_format($value['precio'], 2,',','.'); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div class="alert alert-danger mb-0" role="alert">
                            <i class="fa fa-exclamation-circle"></i> Si ya sos cliente, ingresa con tu usuario y accede a nuestros descuentos por compra mayorista.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="shoping__checkout mt-0">
                <h5>Total Pedido</h5>
                <!-- Resume -->
                <ul>
                    <li>Subtotal <span>$<?php echo number_format($pedido->getTotalFinal(), 2,',','.'); ?></span></li>
                    <!-- Descuentos -->
                    <?php
                        $general = new Configuracion();
                        $data = json_decode($general->getDescuentos(), true);
                        $data = array_reverse($data);
                        $descuento = 0;
                        $PctDescuento = 0;
                        if (!empty($data[0])  && !isset($_SESSION['user'])) :
                            foreach ($data as $key => $value) { 
                                if ($pedido->getTotalFinal() >  $value['precio']) :
                                    $descuento = $pedido->getTotalFinal() * $value['descuento'] / 100;
                                    $PctDescuento = $value['descuento']; ?>
                                    <li>Descuento <?= $value['descuento']."%"; ?> <span>- $<?php echo  number_format($descuento, 2,',','.'); ?></span></li>
                                <?php break;
                                endif;
                            }
                        endif; 
                    ?>
                
                    <li>Total <span>$<?php echo number_format($pedido->getTotalFinal() - $descuento, 2,',','.'); ?></span></li>
                </ul>
                
                <!-- Hidden Inputs -->
                <input type="hidden" name="subtotal" value="<?php echo $pedido->getTotalFinal(); ?>">
                <input type="hidden" name="PctDescuento" value="<?php echo $PctDescuento; ?>">
                <input type="hidden" name="descuento" value="<?php echo $descuento; ?>">
                <input type="hidden" name="total" value="<?php echo $pedido->getTotalFinal() - $descuento; ?>">
                 
                <!-- Danger Bootstrap -->
                 <?php if ($pedido->getTotalFinal() < $general->getMinimo() && !isset($_SESSION['user'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-circle"></i> El minimo de compra para cerrar el pedido es de <strong>$<?php echo number_format($general->getMinimo(), 0,'','.'); ?></strong>
                    </div>
                <?php endif; ?>
                
                <!-- Final Order -->
                <?php if ((!$result['cpanel'] && $pedido->getTotalFinal() >= $general->getMinimo()) || isset($_SESSION['user'])) : ?>
                    <a href="#" id="js-finally-order" data-id="<?php echo $result['Id_Pedido']; ?>" class="primary-btn">Finalizar Pedido</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>