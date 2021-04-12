<div class="banner mb-5">
    <div class="container">
        <div class="row">
            <?php 
                $banners = new Banners();
                $result = $banners->getBannersMini();

                while ( $banner = $result->fetch_object() ) : ?>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic" style="background-image: url(<?php echo $banner->image; ?>);">
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