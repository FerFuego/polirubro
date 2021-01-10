<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php 
                    $rubros = new Rubros();
                    $result = $rubros->getRubros();
                    while( $row = mysqli_fetch_array($result) ) : ?>
                    
                        <div class="col-lg-3">
                            <div class="categories__item">
                                <img src="img/categories/<?php echo $row['Id_Rubro']; ?>.png" alt="">
                                <h5><a href="#"><?php echo $row['Nombre']; ?></a></h5>
                            </div>
                        </div>
                <?php  
                    endwhile;
                    $rubros->closeConnection(); ?>
            </div>
        </div>
    </div>
</section>