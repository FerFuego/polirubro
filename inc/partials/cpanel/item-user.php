<tr id="item_user_<?php echo $user->Id_Cliente; ?>">
    <td class="text-left">
        <?php echo $user->Id_Cliente; ?>
    </td>
    <td class="text-left">
        <?php echo $user->Nombre; ?>
    </td>
    <td class="text-left">
        <?php echo $user->Usuario; ?>
    </td>
    <td class="text-left">
        <?php echo $user->tipo; ?>
    </td>
    <td class="shoping__cart__item__update text-center">
        <span onclick="getClientdata(this);" data-cli="<?php echo $user->Id_Cliente; ?>" data-toggle="modal" data-target="#clientModal" class="icon_pencil-edit" title="Editar"></span>
    </td>
    <td class="shoping__cart__item__close text-center">
        <form class="js-form-cli-delete">
            <input type="hidden" name="id_item" value="<?php echo $user->Id_Cliente; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>