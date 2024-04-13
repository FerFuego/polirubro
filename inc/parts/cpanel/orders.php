<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <?php if ( isset($_GET['s']) ) : ?>
            <a href="cpanel.php?opcion=pedidos" class="site-btn mb-2">Mostrar Todos</a>
        <?php else : ?>
            <a href="cpanel.php?opcion=pedidos&s=activos" class="site-btn mb-2">Filtrar Abiertos</a>
        <?php endif; ?>

        <?php require 'inc/partials/cpanel/search-orders.php'; ?>
    </div>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th class="text-left">Pedido</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Localidad</th>
                <th class="text-left">Subtotal</th>
                <th class="text-left">Descuento</th>
                <th class="text-left">Importe</th>
                <th class="text-left">Estado</th>
                <th class="text-left" style="min-width: 120px;">Fechas</th>
                <th class="text-left">Ver</th>
                <th class="text-left">Finalizar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $orders = new Pedidos();

                if ( $search !== '') {
                    $result = $orders->getOrdersSearch($opcion, $search);
                } else {
                    $result = $orders->getOrders($opcion);
                }

                $paginator = new Paginator( $result['query'], $result['total'] );
                $results   = $paginator->getData( $limit, $page );

                if ( $results->num_rows > 0 ) :
                    while ( $order = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-order.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="9"><h3>No existen pedidos</h3></td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
    <?php echo $paginator->createLinks( $links, $result['params'], 'product__pagination' ); ?>
</div>