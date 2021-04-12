<div class="col-lg-9">
    <div class="hero__search">
        <div class="hero__search__form">
            <form action="productos.php" method="GET">
                <input type="text" name="s" placeholder="Que estas buscando?" value="<?php echo (isset($search))? $search : ''; ?>">
                <button type="submit" class="site-btn">BUSCAR</button>
            </form>
        </div>
        <div class="hero__search__phone">
            <a href="https://wa.me/<?php echo str_replace(['(',')',' ','-'],['','','',''],$general->whatsapp); ?>" target="_blank" class="d-block hero__search__phone__icon">
                <i class="fa fa-whatsapp"></i>
            </a>
            <div class="hero__search__phone__text">
                <a href="https://wa.me/<?php echo str_replace(['(',')',' ','-'],['','','',''],$general->whatsapp); ?>" target="_blank"><h5><?php echo $general->whatsapp; ?></h5></a>
                <span><?php echo $general->atencion; ?></span>
            </div>
        </div>
    </div>    
</div>