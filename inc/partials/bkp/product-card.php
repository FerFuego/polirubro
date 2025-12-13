<div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo Polirubro::get_slug($product->Rubro); ?>">
    <div class="featured__item">
        <a href="detalle.php?id=<?php echo $product->Id_Producto; ?>" class="featured__item__pic set-bg"
            data-setbg="<?php echo Productos::getImage($product->CodProducto); ?>">
            <!-- <div class="product__discount__percent">-20%</div> -->
            <div class="product__code">
                <h5><?php echo 'COD: ' . $product->CodProducto; ?></h5>
            </div>
        </a>

        <div class="featured__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h6><a href="detalle.php?id=<?php echo $product->Id_Producto; ?>"><?php echo $product->Nombre; ?></a></h6>
            <span><?php echo 'Precio Lista: $ ' . number_format($product->PreVtaFinal1(), 2, ',', '.'); ?></span>
        </div>
    </div>
</div>