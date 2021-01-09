<div class="col-lg-9">
    <div class="hero__search">
        <div class="hero__search__form">
            <form action="#">
                <!-- <div class="hero__search__categories">
                    Todas las Categorias
                    <span class="arrow_carrot-down"></span>
                </div> -->
                <input type="text" placeholder="Que estas buscando?">
                <button type="submit" class="site-btn">BUSCAR</button>
            </form>
        </div>
        <div class="hero__search__phone">
            <div class="hero__search__phone__icon">
                <i class="fa fa-whatsapp"></i>
            </div>
            <div class="hero__search__phone__text">
                <a href="https://wa.me/543537536991" target="_blank"><h5>(3537) 536-991</h5></a>
                <span>Atencion Lunes a Viernes</span>
            </div>
        </div>
    </div>

    <?php if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/nuevo/' || $_SERVER['REQUEST_URI'] === '/nuevo/index.php') :
        require_once('inc/parts/slider.php'); 
    endif; ?>
    
</div>