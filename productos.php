<!-- Head Section Begin -->
<?php require_once('inc/layout/head.php'); ?>
<!-- Head Section End -->

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <?php require_once('inc/parts/categories.php'); ?>
            <?php require_once('inc/parts/search.php'); ?>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<?php require_once('inc/parts/breadcrumb-section.php'); ?>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <!-- Breadcrumb Section Begin -->
                <?php require_once('inc/parts/sidebar.php'); ?>
                <!-- Breadcrumb Section End -->
            </div>
            <div class="col-lg-9 col-md-7">
                
                <!-- Offer Section Begin -->
                <?php require_once('inc/parts/offert-section.php'); ?>
                <!-- Offer Section End -->

                <?php 
                    $productos = new Productos();
                    $result    = $productos->getProducts($id_rubro, $id_subrubro, $id_grupo);
                    $productos->closeConnection();

                    $paginator = new Paginator( $result['query'], $result['total'] );
                    $results   = $paginator->getData( $limit, $page );
                ?>

                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Ordenar Por</span>
                                <select>
                                    <option value="0">Defecto</option>
                                    <option value="0">Menor Precio</option>
                                    <option value="0">Mayor Precio</option>
                                    <option value="0">Antiguos</option>
                                    <option value="0">Recientes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span><?php echo $result['total']; ?></span> Productos encontrados</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ( $results->num_rows > 0 ) : ?>

                    <div class="row">
                        <?php
                            while ( $product = $results->fetch_object() ) :
                                require 'inc/partials/product.php';
                            endwhile;
                        ?>
                    </div>

                    <!-- Paginador -->
                    <?php echo $paginator->createLinks( $links, $result['params'], 'product__pagination' ); ?>
                    <!-- End Paginador -->

                <?php else : ?>
                    <h4>No se encontraron productos en esta categoria</h4>
                <?php endif; ?>

                <?php $paginator->closeConnection(); ?>

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->