<tr id="item_order_<?php echo $order->Id_Pedido; ?>">
    <td class="text-left">
        <?php echo $order->Id_Pedido; ?>
    </td>
    <td class="text-left">
        <?php echo $order->Nombre; ?>
    </td>
    <td class="text-left">
        <?php echo $order->Localidad; ?>
    </td>
    <td class="text-left">
        <?php echo $order->SubTotal ? '$' . number_format($order->SubTotal, 2,',','.') : 0; ?>
    </td>
    <td class="text-left">
        <?php echo $order->Descuento ? '$' . number_format($order->Descuento, 2,',','.') : 0; ?>
    </td>
    <td class="text-left">
        <?php 
            $o = new Pedidos(); 
            $ord = $o->getPedidoTotal($order->Id_Pedido);
            echo $order->ImpTotal > 0 ? '$' . number_format($order->ImpTotal, 2,',','.') : '$' . number_format($ord->Total, 2,',','.'); 
        ?>
    </td>
    <td class="text-left">
        <?php echo ($order->Cerrado == 1) ? "Cerrado" : "Abierto"; ?>
    </td>
    <td class="text-left">
        <?php echo 'Inicio: ' . date("d-m-Y", strtotime($order->FechaIni)); ?>
        <?php echo '<br> Fin: ' . date("d-m-Y", strtotime($order->FechaFin)); ?>
    </td>
    <td class="shoping__cart__item__update text-center">
        <span onclick="getOrderData(this);" data-order="<?php echo $order->Id_Pedido; ?>" data-toggle="modal" data-target="#orderModal" class="icon_zoom-in_alt" title="Editar"></span>
    </td>
    <td class="shoping__cart__item__update text-center">
        <?php if ($order->Cerrado == 0) : ?>
            <span data-ord="<?php echo $order->Id_Pedido; ?>" class="icon_check_alt2 js-finally-order-admin" title="Finalizar"></span>
        <?php endif; ?>
    </td>
    <td class="shoping__cart__item__close text-center">
        <form class="js-form-order-delete">
            <input type="hidden" name="id_item" value="<?php echo $order->Id_Pedido; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>