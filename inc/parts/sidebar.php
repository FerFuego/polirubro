<div class="sidebar">
    <div class="sidebar__item">
        <h4>Precio</h4>
        <div class="price-range-wrap">
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="10" data-max="10000">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
            <div class="range-slider">
                <form class="d-flex justify-content-around" method="GET">
                    <input type="hidden" name="id_rubro" value="<?php echo $id_rubro; ?>">
                    <input type="hidden" name="id_subrubro" value="<?php echo $id_subrubro; ?>">
                    <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>">
                    <input type="hidden" name="order" value="<?php echo $order; ?>">
                    <div class="price-input">
                        <input type="text" name="minamount" id="minamount" value="<?php echo $minamount; ?>">
                        <input type="text" name="maxamount" id="maxamount" value="<?php echo $maxamount; ?>">
                    </div>
                    <input type="submit" class="site-btn-min" value="Filtrar">
                </form>

                <?php if ( isset($minamount) || isset($maxamount) ) : ?>
                    <p class="mt-3 mb-0 text-success">Filtrado de $<?php echo $minamount; ?> a $<?php echo $maxamount; ?>.-</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="sidebar__item d-none d-sm-block">
        <h4>Categorías</h4>
        <ul>
            <?php 
                $rubros = new Rubros();
                $result = $rubros->getRubros();

                while ( $rubro = $result->fetch_object() ) : ?>
                    <li>
                        <a href="productos.php?id_rubro=<?php echo $rubro->Id_Rubro; ?>" id="<?php echo $rubro->Id_Rubro; ?>" data-rubro="<?php echo $rubro->Id_Rubro; ?>" class="item sublistCTA">
                            <?php echo $rubro->Nombre; ?>
                            <span></span>
                        </a>
                        <div class="sublist"></div>
                    </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <!-- <div class="sidebar__item sidebar__item__color--option">
        <h4>Colores</h4>
        <div class="sidebar__item__color sidebar__item__color--white">
            <label for="white">
                Blanco
                <input type="radio" id="white">
            </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--gray">
            <label for="gray">
                Gris
                <input type="radio" id="gray">
            </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--red">
            <label for="red">
                Rojo
                <input type="radio" id="red">
            </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--black">
            <label for="black">
                Negro
                <input type="radio" id="black">
            </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--blue">
            <label for="blue">
                Azul
                <input type="radio" id="blue">
            </label>
        </div>
        <div class="sidebar__item__color sidebar__item__color--green">
            <label for="green">
                Verde
                <input type="radio" id="green">
            </label>
        </div>
    </div> -->
    <!-- <div class="sidebar__item">
        <h4>Popular Size</h4>
        <div class="sidebar__item__size">
            <label for="large">
                Large
                <input type="radio" id="large">
            </label>
        </div>
        <div class="sidebar__item__size">
            <label for="medium">
                Medium
                <input type="radio" id="medium">
            </label>
        </div>
        <div class="sidebar__item__size">
            <label for="small">
                Small
                <input type="radio" id="small">
            </label>
        </div>
        <div class="sidebar__item__size">
            <label for="tiny">
                Tiny
                <input type="radio" id="tiny">
            </label>
        </div>
    </div> -->

    <?php
        $news = new Productos();
        $results = $news->getProductNews(10);

        if ( $results->num_rows > 0 ) : ?>

            <div class="sidebar__item d-none d-sm-block">
                <div class="latest-product__text">
                    <h4>Últimos Productos</h4>
                    <div class="latest-product__slider owl-carousel">
                        <?php   
                            while ( $product = $results->fetch_object() ) :
                                require 'inc/partials/sidebar-card.php';
                            endwhile;
                        ?>
                    </div>
                </div>
            </div>

    <?php endif; ?>

</div>