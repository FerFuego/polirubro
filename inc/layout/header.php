<div class="humberger__menu__overlay"></div>

<!-- Mobile -->
<div class="humberger__menu__wrapper">

    <div class="humberger__menu__logo">
        <a href="/"><img src="img/logo.jpg" alt=""></a>
    </div>

    <div class="humberger__menu__cart">
    </div>

    <div class="humberger__menu__widget">
       <?php echo Polirubro::getItemsSession(); ?>
    </div>

    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="<?php echo (Polirubro::normalize_title() === '')? 'active':''?>"><a href="./">Inicio</a></li>
            <li class="<?php echo (Polirubro::normalize_title() === 'Nosotros')? 'active':''?>"><a href="./nosotros.php">Nosotros</a></li>
            <li class="<?php echo (Polirubro::normalize_title() === 'Productos')? 'active':''?>"><a href="./productos.php">Productos</a></li>
            <?php if ( isset($_SESSION["id_user"]) ) : ?>
                <li class="<?php echo (Polirubro::normalize_title() === 'Carrito')? 'active':''?>"><a href="./carrito.php">Carrito</a></li>
            <?php endif; ?>
            <li class="<?php echo (Polirubro::normalize_title() === 'Contacto')? 'active':''?>"><a href="./contacto.php">Contacto</a></li>
            <?php if ( Polirubro::is_Admin() ) : ?>
                <li class="<?php echo (Polirubro::normalize_title() === 'CPanel')? 'active':''?>"><a href="./cpanel.php">Administrador</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div id="mobile-menu-wrap"></div>

    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>

    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> <?php echo Polirubro::EMAIL; ?></li>
            <li><?php echo Polirubro::ADDRESS; ?></li>
        </ul>
    </div>

</div>

<header class="header">
     <!-- Top bar -->
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> <?php echo Polirubro::EMAIL; ?></li>
                            <li><?php echo Polirubro::ADDRESS; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            <?php echo Polirubro::getItemsSession(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="img/logo.jpg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="<?php echo (Polirubro::normalize_title() === '')? 'active':''?>"><a href="./">Inicio</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Nosotros')? 'active':''?>"><a href="./nosotros.php">Nosotros</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Productos')? 'active':''?>"><a href="./productos.php">Productos</a></li>
                        <?php if ( isset($_SESSION["id_user"]) ) : ?>
                            <li class="<?php echo (Polirubro::normalize_title() === 'Carrito')? 'active':''?>"><a href="./carrito.php">Carrito</a></li>
                        <?php endif; ?>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Contacto')? 'active':''?>"><a href="./contacto.php">Contacto</a></li>
                        <?php if ( Polirubro::is_Admin() ) : ?>
                            <li class="<?php echo (Polirubro::normalize_title() === 'CPanel')? 'active':''?>"><a href="./cpanel.php">Admin</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2">
                <?php echo Polirubro::getResumenCart(); ?>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
    
</header>