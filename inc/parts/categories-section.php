<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php 
                    $rubros = new Rubros();
                    $result = $rubros->getRubros();

                    while( $categ = $result->fetch_object() ) :
                        require 'inc/partials/category-card.php'; 
                    endwhile;

                    $rubros->closeConnection(); ?>
            </div>
        </div>
    </div>
</section>