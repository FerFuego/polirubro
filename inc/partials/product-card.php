<div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo Polirubro::get_slug($product->Rubro); ?>">
    <div class="featured__item">
        <div class="featured__item__pic set-bg" data-setbg="img/featured/feature-1.jpg">
            <ul class="featured__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="featured__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h6><a href="#"><?php echo $product->Nombre; ?></a></h6>
            <h5><?php echo $product->Id_Producto; ?></h5>
        </div>
    </div>
</div>