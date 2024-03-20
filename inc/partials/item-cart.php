<tr>
    <td class="shoping__cart__item">
        <div class="d-flex">
                <img src="<?php echo Productos::getImage( $product->CodProducto ); ?>" width="60px">
                <div class="d-flex flex-column">
                    <b><?php echo $product->CodProducto; ?></b>
                    <h5><?php echo $product->Nombre; ?></h5>
                </div>
            </div>
        </td>
        <td class="shoping__cart__note">
            <textarea type="text" name="nota" id="nota_<?php echo $product->Auto; ?>"><?php echo $product->Notas; ?></textarea>
        </td>
        <td class="shoping__cart__price">
            $<?php echo number_format($product->PreVtaFinal1, 2,',','.'); ?>
        </td>
        <td class="shoping__cart__quantity">
            <div class="quantity">
                <div class="pro-qty">
                    <input type="text" name="cant" id="cant_<?php echo $product->Auto; ?>" value="<?php echo $product->Cantidad; ?>">
                </div>
            </div>
        </td>
        <td class="shoping__cart__total">
            $<?php echo number_format($product->ImpTotal, 2,',','.'); ?>
        </td>
        <td class="shoping__cart__item__update">
            <form class="js-form-update">
                <input type="hidden" name="id_item" value="<?php echo $product->Auto; ?>">
                <input type="hidden" name="codprod" value="<?php echo $product->CodProducto; ?>">
                <span onclick="$(this).closest('form').submit();" class="icon_refresh" title="Actualizar"></span>
            </form>
        </td>
    <td class="shoping__cart__item__close">
        <form class="js-form-delete">
            <input type="hidden" name="id_item" value="<?php echo $product->Auto; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>