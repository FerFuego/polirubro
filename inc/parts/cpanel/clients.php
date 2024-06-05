<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <button data-toggle="modal" onclick="cleanModal();" data-target="#clientModal" class="site-btn">Nuevo Usuario</button>
        <?php require 'inc/partials/cpanel/search-user.php'; ?>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Usuario</th>
                <th class="text-left">Tipo</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                
                $users = new Usuarios();

                if ( $search != '') {
                    $result = $users->getUsersSearch($opcion, $search);
                } else {
                    $result = $users->getUsersCpanel($opcion);
                }

                $paginator = new Paginator( $result['query'], $result['total'] );
                $results   = $paginator->getData( $limit, $page );

                if ( $results->num_rows > 0 ) :
                    while ( $user = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-user.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="6"><h3>No existen usuarios</h3></td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
    <?php echo $paginator->createLinks( $links, $result['params'], 'product__pagination' ); ?>
</div>