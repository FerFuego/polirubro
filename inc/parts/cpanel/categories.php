<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <button data-toggle="modal" onclick="cleanCategModal();" data-target="#categModal" class="site-btn mb-2">Nueva Categoria</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-left">Orden</th>
                <th class="text-left">Icono</th>
                <th class="text-left">Titulo</th>
                <!-- <th class="text-left">Color</th> -->
                <th class="text-left">Link</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $categories = new Categorias();
                $results = $categories->getCategories();

                if ( $results ) :
                    while ( $categ = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-category.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="6"><h3>No existen categorias</h3></td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>