<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php 
                    $categs = new Categorias();
                    $result = $categs->getCategories();

                    while( $categ = $result->fetch_object() ) :
                        require 'inc/partials/category-card.php'; 
                    endwhile;

                    $categs->closeConnection(); ?>
            </div>
        </div>
    </div>
</section>