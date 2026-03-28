<div class="header__top__right__auth">
    <strong><?php echo $_SESSION['user']; ?></strong>
    <?php if (strtolower($_SESSION['user']) !== 'poliprecios'): ?>
        <a href="mi-cuenta.php" class="ml-2"><i class="fa fa-user"></i> Mi Cuenta</a>
    <?php endif; ?>
    <a href="logout.php" class="ml-2"><i class="fa fa-sign-out"></i> Salir</a>
</div>