<div class="banner mb-5">
    <div class="container">
        <div class="row">
            <?php 
                $banners = new Banners();
                $result = $banners->getBannersMini();

                while ( $banner = $result->fetch_object() ) : ?>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic" style="background-image: url(<?php echo $banner->image; ?>);">
                            <?php if ($banner->title) : ?>
                                <h2><?php echo $banner->title; ?></h2>
                            <?php endif; ?>
                            <?php if ($banner->text) : ?>
                                <p><?php echo $banner->text; ?></p>
                            <?php endif; ?>
                            <?php if ( $banner->link ) : ?>
                                <a href="<?php echo $banner->link; ?>" class="primary-btn">COMPRAR AHORA</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
            <?php endwhile; ?>
        </div>
    </div>
</div>