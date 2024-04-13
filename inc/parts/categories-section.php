<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php 
                    $categs = new Categorias();
                    $result = $categs->getCategories();

                    if ( $result ) :
                        while( $categ = $result->fetch_object() ) :
                            require 'inc/partials/category-card.php'; 
                        endwhile;
                    endif;
                ?>
            </div>
        </div>
    </div>
</section>