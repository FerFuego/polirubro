<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <button data-toggle="modal" onclick="cleanModal();" data-target="#bannerModal" class="site-btn mb-2">Nuevo Banner</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-left">Orden</th>
                <th class="text-left">Imagen</th>
                <th class="text-left">Titulo</th>
                <th class="text-left">Texto</th>
                <th class="text-left">Link</th>
                <th class="text-left">Mini</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $banners = new Banners();
                $results = $banners->getBanners();

                if ( $results->num_rows > 0 ) :
                    while ( $banner = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-banner.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="6"><h3>No existen banners</h3></td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>