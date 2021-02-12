<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <ul>
                        <li><b>Direccion:</b> <?php echo Polirubro::ADDRESS; ?></li>
                        <li><b>Telefono:</b> <?php echo Polirubro::PHONE; ?></li>
                        <li><b>WhatsApp:</b> <?php echo Polirubro::WHATSAPP; ?></li>
                        <li><b>Email:</b> <?php echo Polirubro::EMAIL; ?></li>
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
                        <li class="<?php echo (Polirubro::normalize_title() === 'Contacto')? 'active':''?>"><a href="./contacto.php">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <div class="footer__about__logo">
                        <a href="/"><img src="img/logo.jpg" alt=""></a>
                    </div>
                    <br><br>
                    <h6>Buscanos en nuestras redes</h6>
                    <br>
                    <!--<p>Recibi en tu email, todas nuestras ofertas</p>
                     <form action="#">
                        <input type="text" placeholder="Ingresa tu email">
                        <button type="Enviar" class="site-btn">Suscribirme</button>
                    </form> -->
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados</p>
                    </div>
                    <div class="footer__copyright__payment">
                        <!-- <img src="img/payment-item.png" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>