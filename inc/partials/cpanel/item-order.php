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
        <?php 
            $o = new Pedidos(); 
            $ord = $o->getPedidoTotal($order->Id_Pedido);
            echo '$' . number_format($ord->Total, 2,',','.'); 
            $o->closeConnection();
        ?>
    </td>
    <td class="text-left">
        <?php echo ($order->Cerrado == 1) ? "Cerrado" : "Abierto"; ?>
    </td>
    <td class="text-left">
        <?php echo $order->FechaIni; ?>
    </td>
    <td class="text-left">
        <?php echo $order->FechaFin; ?>
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