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

<!-- Product Details Section Begin -->
<?php if ( $id ) : 
    
    $product = new Productos( $id ); 
    
    if ( $product->getNombre() ) : ?>

        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large" src="<?php echo Productos::getImage( $product->getCode() ); ?>" alt="">
                            </div>
                            <!--  <div class="product__details__pic__slider owl-carousel">
                                <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                    src="img/product/details/thumb-1.jpg" alt="">
                                <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                    src="img/product/details/thumb-2.jpg" alt="">
                                <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                    src="img/product/details/thumb-3.jpg" alt="">
                                <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                    src="img/product/details/thumb-4.jpg" alt="">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3><?php echo $product->getNombre(); ?></h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <!-- <i class="fa fa-star-half-o"></i> -->
                                <!-- <span>(18 reviews)</span> -->
                            </div>

                            <h4>Cod.: <?php echo $product->getCode(); ?></h4>

                            <form class="js-form-cart">
                                <div class="product__details__price">$<?php echo number_format($product->PreVtaFinal1(), 2,',','.'); ?></div>
                                <input type="hidden" name="id_product" value="<?php echo $product->getID(); ?>">
                                <input type="hidden" name="cod_product" value="<?php echo $product->getCode(); ?>">
                                <input type="hidden" name="name_product" value="<?php echo $product->getNombre(); ?>">
                                <input type="hidden" name="price_product" value="<?php echo $product->PreVtaFinal1(); ?>">

                                <div>
                                    <textarea type="text" name="nota" class="product__details__note" placeholder="Agregar Nota"></textarea>
                                </div>

                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" name="cant" min="1" max="99999" value="1"> 
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="primary-btn" value="AGREGAR AL CARRITO">
                                <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                            </form>

                            <div class="js-login-message"></div>

                            <ul>
                                <?php if ($product->marca) : ?>
                                    <li><b>Marca</b> <span><?php echo ucfirst(strtolower($product->marca)); ?></span></li>
                                <?php endif; ?>
                                
                                <?php if ($product->rubro) : ?>
                                    <li><b>Rubro</b> <span><?php echo ucfirst(strtolower($product->rubro)); ?></span></li>
                                <?php endif; ?>
                                
                                <?php if ($product->subrubro) : ?>
                                    <li><b>SubRubro</b> <span><?php echo ucfirst(strtolower($product->subrubro)); ?></span></li>
                                <?php endif; ?>
                                
                                <?php if ($product->grupo) : ?>
                                    <li><b>Grupo</b> <span><?php echo ucfirst(strtolower($product->grupo)); ?></span></li>
                                <?php endif; ?>

                                <li><b>Disponibilidad</b> <span>Hay Stock</span></li>
                                <!-- <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                                <li><b>Weight</b> <span>0.5 kg</span></li>
                                <li><b>Share on</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">Descripcion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                        aria-selected="false">Informacion</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Descripcion del Producto</h6>

                                        <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                            Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                            suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                            vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                            Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                            accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                            pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                            elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                            et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                            vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                            ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                            elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                            porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                            nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                            Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                            porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                            sed sit amet dui. Proin eget tortor risus.</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Infomacion del Producto</h6>

                                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                            ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                            elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                            porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                            nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

    <?php else : ?>

        <section class="product-details container spad">
            <h2>Producto no encontrado</h2>
        </section>

    <?php endif; ?>

<?php else : ?>

    <section class="product-details container spad">
        <h2>Producto no encontrado</h2>
    </section>

<?php endif; ?>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<?php require_once('inc/parts/related-products.php'); ?>
<!-- Related Product Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->