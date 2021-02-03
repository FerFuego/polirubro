<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
            <!-- <div class="product__discount__percent">-20%</div> -->
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h6><a href="detalle.php?id=<?php echo $product->CodProducto; ?>"><?php echo $product->Nombre; ?></a></h6>
            <h5><?php echo $product->CodProducto; ?></h5>
            <?php if ( isset($_SESSION["id_user"]) ) : ?>
                <span><?php echo 'Precio Lista: $ '. $product->PreVtaFinal1; ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>