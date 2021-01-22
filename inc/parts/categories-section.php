<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php 
                    $rubros = new Rubros();
                    $result = $rubros->getRubros();
                    while( $categ = $results->fetch_object() ) : ?>
                    
                        <div class="col-lg-3">
                            <div class="categories__item">
                                <img src="img/categories/<?php echo $categ->Id_Rubro; ?>.png" alt="">
                                <h5><a href="#"><?php echo $categ->Nombre; ?></a></h5>
                            </div>
                        </div>
                <?php  
                    endwhile;
                    $rubros->closeConnection(); ?>
            </div>
        </div>
    </div>
</section>