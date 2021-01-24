<div class="col-lg-9">
    <div class="hero__search">
        <div class="hero__search__form">
            <form action="productos.php" method="GET">
                <!-- <div class="hero__search__categories">
                    Todas las Categorias
                    <span class="arrow_carrot-down"></span>
                </div> -->
                <input type="text" name="s" placeholder="Que estas buscando?" value="<?php echo (isset($search))? $search : ''; ?>">
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
</div>