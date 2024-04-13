<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Productos Relacionados</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
                $related = new Productos();
                $results = $related->getRelatedProducts($product->getRubroID(), $product->getSubRubroID(), $product->getGrupoID(), $product->getID());

                while ( $product = $results->fetch_object() ) :
                    require 'inc/partials/product-card.php';
                endwhile; 
            ?>
        </div>
    </div>
</section>