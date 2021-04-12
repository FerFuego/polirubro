<div class="latest-prdouct__slider__item">
    <a href="detalle.php?id=<?php echo $product->CodProducto; ?>" class="latest-product__item">
        <div class="latest-product__item__text">
            <img src="<?php echo Productos::getImage( $product->CodProducto ); ?>" alt="">
            <h6><?php echo $product->Nombre; ?></h6>
            <span><?php echo $product->Id_Producto; ?></span>
        </div>
    </a>
</div>