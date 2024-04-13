<?php
    $offert = new Productos();
    $results = $offert->getProductsOffert($id_rubro, $id_subrubro, $id_grupo);

    if ( $results->num_rows > 0 ) : ?>

        <div class="product__discount">
            <div class="section-title product__discount__title">
                <h2>Ofertas</h2>
            </div>
            <div class="row">
                <div class="product__discount__slider owl-carousel">
                    <?php   
                        while ( $product = $results->fetch_object() ) :
                            require 'inc/partials/product.php';
                        endwhile;
                    ?>
                </div>
            </div>
        </div>

<?php endif; ?>