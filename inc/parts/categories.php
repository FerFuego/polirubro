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

                while ( $row = mysqli_fetch_array($result) ) : ?>
                    <li>
                        <a href="productos.php?id_rubro=<?php echo $row['Id_Rubro']; ?>" id="<?php echo $row['Id_Rubro']; ?>" data-rubro="<?php echo $row['Id_Rubro']; ?>" class="item sublistCTA">
                            <?php echo $row['Nombre']; ?>
                            <span></span>
                        </a>
                        <div class="sublist"></div>
                    </li>
            <?php endwhile; 
                $rubros->closeConnection(); ?>
        </ul>
    </div>
</div>