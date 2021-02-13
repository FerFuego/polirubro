<tr>
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
        <?php echo $user->Password; ?>
    </td>
    <td class="shoping__cart__item__update text-center">
        <a href=""><span onclick="$(this).closest('form').submit();" class="icon_refresh" title="Actualizar"></span></a>
    </td>
    <td class="shoping__cart__item__close text-center">
        <form class="js-form-delete">
            <input type="hidden" name="id_item" value="<?php echo $user->Id_Cliente; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>