<tr id="item_categ_<?php echo $categ->id_categ; ?>">
    <td class="text-left">
        <?php echo $categ->orden; ?>
    </td>
    <td class="text-left">
        <?php if ( $categ->icon ) : ?>
            <img src="<?php echo $categ->icon; ?>" width="50px">
        <?php endif; ?>
    </td>
    <td class="text-left">
        <?php echo $categ->title; ?>
    </td>
    <!-- <td class="text-left">
        <?php //echo $categ->color; ?>
    </td> -->
    <td class="text-left">
        <?php echo $categ->link; ?>
    </td>
    <td class="shoping__cart__item__update text-center">
        <span onclick="getCategdata(this);" data-categ="<?php echo $categ->id_categ; ?>" data-toggle="modal" data-target="#categModal" class="icon_pencil-edit" title="Editar"></span>
    </td>
    <td class="shoping__cart__item__close text-center">
        <form class="js-form-categ-delete">
            <input type="hidden" name="id_item" value="<?php echo $categ->id_categ; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>