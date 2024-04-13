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
                                <?php if ($banner->title) : ?>
                                    <!-- <span>PRODUCTOS</span> -->
                                    <h2><?php echo $banner->title; ?></h2>
                                <?php endif; ?>
                                <?php if ($banner->text) : ?>
                                    <p><?php echo $banner->text; ?></p>
                                <?php endif; ?>
                                <?php if ($banner->link) : ?>
                                    <a href="<?php echo $banner->link; ?>" class="primary-btn">COMPRAR AHORA</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>