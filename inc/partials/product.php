<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <?php $images = Productos::getProductImages($product->CodProducto, 3); ?>
        <div class="product__item__pic product-card-slider">
            <?php foreach ($images as $index => $image): ?>
                <div class="slider-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <a href="detalle.php?id=<?php echo $product->Id_Producto; ?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $product->Nombre; ?>">
                    </a>
                </div>
            <?php endforeach; ?>

            <?php if (count($images) > 1): ?>
                <div class="slider-nav">
                    <button class="slider-prev"><i class="fa fa-angle-left"></i></button>
                    <button class="slider-next"><i class="fa fa-angle-right"></i></button>
                </div>
                <div class="slider-dots">
                    <?php foreach ($images as $index => $image): ?>
                        <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="product__code">
                <h5><?php echo 'COD: ' . $product->CodProducto; ?></h5>
            </div>
        </div>
        <div class="product__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h6><a href="detalle.php?id=<?php echo $product->Id_Producto; ?>"><?php echo $product->Nombre; ?></a></h6>
            <?php if ($general->showPrices()): ?>
                <p class="text-danger">
                    <?php echo 'Precio Lista: <strong>$ ' . number_format(Productos::PreVtaFinal($product->PreVtaFinal1), 2, ',', '.') . '</strong>'; ?>
                </p>
                <?php if (($_SESSION['Id_Cliente'] ?? 0) != 1): ?>
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
            <?php endif; ?>
        </div>
    </div>
</div>