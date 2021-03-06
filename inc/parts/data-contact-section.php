<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Telefono</h4>
                    <a href="tel:<?php echo str_replace(['(',')',' ','-'],['','','',''],$general->telefono); ?>"><p><?php echo $general->telefono; ?></p></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Direccion</h4>
                    <p><?php echo $general->direccion; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Horario</h4>
                    <p><?php echo $general->atencion; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <a href="mailto:<?php echo $general->email; ?>"><p><?php echo $general->email; ?></p></a>
                </div>
            </div>
        </div>
    </div>
</section>