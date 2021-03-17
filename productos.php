<?php require_once('inc/layout/head.php'); ?>

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

                <?php 
                    if ( $search != '') {
                        $productos = new Productos();
                        $result    = $productos->getProductSearch($search);
                        $productos->closeConnection();
                    } else {
                        $productos = new Productos();
                        $result    = $productos->getProducts($id_rubro, $id_subrubro, $id_grupo, $minamount, $maxamount, $order);
                        $productos->closeConnection();
                    }

                    $paginator = new Paginator( $result['query'], $result['total'] );
                    $results   = $paginator->getData( $limit, $page );
                ?>

                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <form id="form-order-prod" class="d-flex justify-content-around" method="GET">
                                <input type="hidden" name="id_rubro" value="<?php echo $id_rubro; ?>">
                                <input type="hidden" name="id_subrubro" value="<?php echo $id_subrubro; ?>">
                                <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>">
                                <input type="hidden" name="minamount" id="minamount" value="<?php echo $minamount; ?>">
                                <input type="hidden" name="maxamount" id="maxamount" value="<?php echo $maxamount; ?>">
                                <div class="filter__sort">
                                    <span>Ordenar Por</span>
                                    <select name="order" id="select-order-prod">
                                        <option value="0">Defecto</option>
                                        <option value="ASC" <?php echo ($order == 'ASC') ? 'selected': ''; ?>>Menor Precio</option>
                                        <option value="DESC" <?php echo ($order == 'DESC') ? 'selected': ''; ?>>Mayor Precio</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="filter__found">
                                <h6 class="text-right"><span><?php echo $result['total']; ?></span> Productos encontrados</h6>
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

                <!-- Offer Section Begin -->
                <?php require_once('inc/parts/offert-section.php'); ?>
                <!-- Offer Section End -->

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->