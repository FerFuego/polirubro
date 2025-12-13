<section class="featured spad">
    <?php
    $products = new Productos();
    $results = $products->getRecentProducts();

    if ($results->num_rows > 0): ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Lista de Últimos Productos</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                while ($product = $results->fetch_object()):
                    require 'inc/partials/product-card.php';
                endwhile;
                ?>
            </div>
        </div>

    <?php endif; ?>

</section>