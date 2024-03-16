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
    <td class="">
        <?php echo $product->Notas; ?>
    </td>
    <td class="shoping__cart__price">
        $<?php echo number_format($product->PreVtaFinal1, 2,',','.'); ?>
    </td>
    <td class="shoping__cart__price">
        <?php echo $product->Cantidad; ?>
    </td>
    <td class="shoping__cart__total">
        $<?php echo number_format($product->ImpTotal, 2,',','.'); ?>
    </td>
</tr>