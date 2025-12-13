<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <a href="detalle.php?id=<?php echo $product->Id_Producto; ?>" class="product__item__pic set-bg"
            data-setbg="<?php echo Productos::getImage($product->CodProducto); ?>">
            <!-- <div class="product__discount__percent">-20%</div> -->
            <div class="product__code">
                <h5><?php echo 'COD: ' . $product->CodProducto; ?></h5>
            </div>
        </a>
        <div class="product__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h6><a href="detalle.php?id=<?php echo $product->Id_Producto; ?>"><?php echo $product->Nombre; ?></a></h6>
            <?php if ($general->showPrices()): ?>
                <p class="text-danger">
                    <?php echo 'Precio Lista: <strong>$ ' . number_format(Productos::PreVtaFinal($product->PreVtaFinal1), 2, ',', '.') . '</strong>'; ?>
                </p>
                <form class="js-form-cart">
                    <input type="hidden" name="id_product" value="<?php echo $product->Id_Producto; ?>">
                    <input type="hidden" name="cod_product" value="<?php echo $product->CodProducto; ?>">
                    <input type="hidden" name="name_product" value="<?php echo $product->Nombre; ?>">
                    <input type="hidden" name="price_product"
                        value="<?php echo number_format(Productos::PreVtaFinal($product->PreVtaFinal1), 2, ',', '.'); ?>">
                    <div class="d-flex">
                        <textarea type="text" name="nota" class="product__details__note"
                            placeholder="Agregar Nota"></textarea>
                    </div>

                    <div class="product__details__quantity mb-2">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="number" name="cant" min="1" max="99999" value="1">
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="primary-btn add-to-cart mb-2" value="+ CARRITO">
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>