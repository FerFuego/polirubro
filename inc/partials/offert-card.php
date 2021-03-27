<div class="col-lg-4">
    <div class="product__discount__item">
        <div class="product__discount__item__pic set-bg"
            data-setbg="img/product/product-5.jpg">
            <div class="product__discount__percent">-20%</div>
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__discount__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h5><a href="#"><?php echo $product->Nombre; ?></a></h5>
            <div class="product__item__price">
                <?php echo $product->Id_Producto; ?> 
                <!-- <span>$36.00</span> -->
            </div>
        </div>
    </div>
</div>