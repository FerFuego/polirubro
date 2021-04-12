<tr id="item_prod_<?php echo $product->Id_Producto; ?>">
    <td>
        <img src="<?php echo Productos::getImage( $product->CodProducto ); ?>" width="100px">
    </td>
    <td class="text-left">
        <?php echo $product->CodProducto; ?>
    </td>
    <td class="text-left"  style="white-space:nowrap">
        <?php echo $product->Nombre; ?>
    </td>
    <td class="text-left">
        <?php echo $product->Marca; ?>
    </td>
    <td class="text-left">
        <?php echo $product->Rubro; ?>
    </td>
    <td class="text-left">
        <?php echo $product->SubRubro; ?>
    </td>
    <td class="text-left">
        <?php echo $product->Grupo; ?>
    </td>
    <td class="text-left">
        <?php echo $product->Novedad; ?>
    </td>
    <td class="text-left">
        <?php echo $product->Oferta; ?>
    </td>
    <td class="text-left">
        <?php echo $product->Observaciones; ?>
    </td>
    <td class="shoping__cart__item__update text-center">
        <span onclick="getProddata(this);" data-prod="<?php echo $product->CodProducto; ?>" data-toggle="modal" data-target="#productModal" class="icon_pencil-edit" title="Editar"></span>
    </td>
    <td class="shoping__cart__item__close text-center">
        <form class="js-form-prod-delete">
            <input type="hidden" name="id_item" value="<?php echo $product->CodProducto; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>