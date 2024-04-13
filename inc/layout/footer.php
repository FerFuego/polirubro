<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <ul>
                        <li><b>Direccion:</b> <?php echo $general->direccion; ?></li>
                        <li><b>Telefono:</b> <?php echo $general->telefono; ?></li>
                        <li><b>WhatsApp:</b> <?php echo $general->whatsapp; ?></li>
                        <li><b>Email:</b> <?php echo $general->email; ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Menu del sitio</h6>
                    <ul>
                        <li class="<?php echo (Polirubro::normalize_title() === '')? 'active':''?>"><a href="./">Inicio</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Nosotros')? 'active':''?>"><a href="./nosotros.php">Nosotros</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Productos')? 'active':''?>"><a href="./productos.php">Productos</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Carrito')? 'active':''?>"><a href="./carrito.php">Carrito</a></li>
                        <li class="<?php echo (Polirubro::normalize_title() === 'Contacto')? 'active':''?>"><a href="./contacto.php">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <div class="footer__about__logo">
                        <a href="/"><img src="<?php echo $general->logo; ?>" alt="logo"></a>
                    </div>
                    <br><br>
                    <?php if ($general->facebook || $general->instagram || $general->twitter) : ?>
                        <h6>Buscanos en nuestras redes</h6>
                    <?php endif; ?>
                    <br>
                    <!--<p>Recibi en tu email, todas nuestras ofertas</p>
                     <form action="#">
                        <input type="text" placeholder="Ingresa tu email">
                        <button type="Enviar" class="site-btn">Suscribirme</button>
                    </form> -->
                    <div class="footer__widget__social">
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <div class="footer__copyright__payment">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Desarrollo Web: <a href="https://lucianocolmano.com.ar/" class="text-white" target="_blank">Colmano & Catalano</a></p>
                            <!-- <img src="img/payment-item.png" alt=""> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Js Plugins -->
<script src="dist/js/jquery-3.3.1.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/jquery.nice-select.min.js"></script>
<script src="dist/js/jquery-ui.min.js"></script>
<script src="dist/js/jquery.slicknav.js"></script>
<script src="dist/js/mixitup.min.js"></script>
<script src="dist/js/owl.carousel.min.js"></script>
<script src="dist/js/toastr.min.js"></script>
<script src="dist/js/main.js"></script>

</body>

</html>