<div class="sidebar sidebar-cpanel col-3">
    <div class="sidebar__item text-center mt-3">
        <h2 class="text-white">Panel de Control</h2>
    </div>
    <div class="sidebar__item">
        <ul>
            <li><a href="cpanel.php?opcion=importar" class="<?php echo (isset($opcion) && $opcion == 'importar') ? 'active' : '';?> item">Importar Productos</a></li>
            <li><a href="cpanel.php?opcion=productos" class="<?php echo (isset($opcion) && $opcion == 'productos') ? 'active' : '';?> item">Gestion de Productos</a></li>
            <li><a href="cpanel.php?opcion=clientes" class="<?php echo (isset($opcion) && $opcion == 'clientes') ? 'active' : '';?> item">Gestion de Clientes</a></li>
            <li><a href="cpanel.php?opcion=banners" class="<?php echo (isset($opcion) && $opcion == 'banners') ? 'active' : '';?> item">Gestion de Banners</a></li>
            <li><a href="logout.php" class="item">Cerrar Sesion</a></li>
        </ul>
    </div>
</div>