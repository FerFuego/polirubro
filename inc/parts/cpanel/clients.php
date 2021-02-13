<div class="shoping__cart__table">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Usuario</th>
                <th class="text-left">Password</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $users = new Usuarios();
                $result = $users->getUsersCpanel($opcion);
                $users->closeConnection();

                $paginator = new Paginator( $result['query'], $result['total'] );
                $results   = $paginator->getData( $limit, $page );

                if ( $results->num_rows > 0 ) :
                    while ( $user = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-user.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="5"><h3>No existen usuarios</h3></td>
                    </tr>
                <?php endif;

                $paginator->closeConnection();
            ?>
        </tbody>
    </table>
    <?php echo $paginator->createLinks( $links, $result['params'], 'product__pagination' ); ?>
</div>