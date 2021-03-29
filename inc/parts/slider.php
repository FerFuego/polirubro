<section class="slider">
    <div class="container">
        <div class="row">
            <div class="home__slider owl-banner-carousel owl-carousel">
                <?php 
                    $banners = new Banners();
                    $result = $banners->getBannersSlider();

                    while ( $banner = $result->fetch_object() ) : ?>

                        <div class="hero__item col-lg-12 set-bg" data-setbg="<?php echo $banner->image; ?>">
                            <div class="hero__text">
                                <span>PRODUCTOS</span>
                                <h2><?php echo $banner->title; ?></h2>
                                <p><?php echo $banner->text; ?></p>
                                <a href="<?php echo $banner->link; ?>" class="primary-btn">COMPRAR AHORA</a>
                            </div>
                        </div>
                        
                <?php endwhile; 
                    $banners->closeConnection(); ?>
            </div>
        </div>
    </div>
</section>