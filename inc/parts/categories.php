<div class="col-lg-3">
    <div class="hero__categories">
        <div class="hero__categories__all">
            <i class="fa fa-bars"></i>
            <span>Categorias</span>
        </div>
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
</div>