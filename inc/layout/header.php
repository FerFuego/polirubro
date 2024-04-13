<div class="humberger__menu__overlay"></div>

<!-- Mobile -->
<div class="humberger__menu__wrapper">

    <div class="humberger__menu__logo">
        <a href="/"><img src="img/logo.jpg" alt=""></a>
    </div>

    
    <div class="humberger__menu__widget d-flex justify-content-between">
        <div class="humberger__menu__cart mb-0">
            <a href="./carrito.php" class="text-black"><i class="fa fa-shopping-bag"></i> Carrito</a>
        </div>
       <?php echo Polirubro::getItemsSession(); ?>
    </div>

    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="<?php echo (Polirubro::normalize_title() === '')? 'active':''?>"><a href="./">Home</a></li>
            <li class="<?php echo (Polirubro::normalize_title() === 'Nosotros')? 'active':''?>"><a href="./nosotros.php">Nosotros</a></li>
            <li class="<?php echo (Polirubro::normalize_title() === 'Productos')? 'active':''?>"><a href="./productos.php">Productos</a></li>
            <li class="<?php echo (Polirubro::normalize_title() === 'Carrito')? 'active':''?>"><a href="./carrito.php">Carrito</a></li>
            <li class="<?php echo (Polirubro::normalize_title() === 'Contacto')? 'active':''?>"><a href="./contacto.php">Contacto</a></li>
            <?php if ( Polirubro::is_Admin() ) : ?>
                <li><a href="cpanel.php" class="<?php echo (!isset($opcion) || $opcion == '') ? 'active' : '';?> item">Dashboard</a></li>
                <li><a href="cpanel.php?opcion=importar" class="<?php echo (isset($opcion) && $opcion == 'importar') ? 'active' : '';?> item">Importar Productos</a></li>
                <li><a href="cpanel.php?opcion=productos" class="<?php echo (isset($opcion) && $opcion == 'productos') ? 'active' : '';?> item">Gestion de Productos</a></li>
                <li><a href="cpanel.php?opcion=clientes" class="<?php echo (isset($opcion) && $opcion == 'clientes') ? 'active' : '';?> item">Gestion de Clientes</a></li>
                <li><a href="cpanel.php?opcion=banners" class="<?php echo (isset($opcion) && $opcion == 'banners') ? 'active' : '';?> item">Gestion de Banners</a></li>
                <li><a href="cpanel.php?opcion=categories" class="<?php echo (isset($opcion) && $opcion == 'categories') ? 'active' : '';?> item">Gestion de Categorias</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div id="mobile-menu-wrap"></div>

    <div class="header__top__right__social">
        <?php if ($general->facebook) : ?>
            <a href="<?php echo $general->facebook; ?>" targte="_blank"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>
        <?php if ($general->instagram) : ?>
            <a href="<?php echo $general->instagram; ?>" targte="_blank"><i class="fa fa-instagram"></i></a>
        <?php endif; ?>
        <?php if ($general->twitter) : ?>
            <a href="<?php echo $general->twitter; ?>" targte="_blank"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>
    </div>

    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> <?php echo $general->email; ?></li>
            <li><?php echo $general->direccion; ?></li>
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
                            <li><i class="fa fa-envelope"></i> <?php echo $general->email; ?></li>
                            <li><?php echo $general->direccion; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <?php if ($general->facebook || $general->instagram || $general->twitter) : ?>
                            <div class="header__top__right__social">
                                <?php if ($general->facebook) : ?>
                                    <a href="<?php echo $general->facebook; ?>" targte="_blank"><i class="fa fa-facebook"></i></a>
                                <?php endif; ?>
                                <?php if ($general->instagram) : ?>
                                    <a href="<?php echo $general->instagram; ?>" targte="_blank"><i class="fa fa-instagram"></i></a>
                                <?php endif; ?>
                                <?php if ($general->twitter) : ?>
                                    <a href="<?php echo $general->twitter; ?>" targte="_blank"><i class="fa fa-twitter"></i></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
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
                    <a href="/"><img src="<?php echo $general->logo; ?>" alt="logo"></a>
                </div>
            </div>
            <div class="col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="<?php echo (Polirubro::normalize_title() === '')? 'active':''?>"><a href="./">Inicio</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Nosotros')? 'active':''?>"><a href="./nosotros.php">Nosotros</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Productos')? 'active':''?>"><a href="./productos.php">Productos</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Carrito')? 'active':''?>"><a href="./carrito.php">Carrito</a></li>
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