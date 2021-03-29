<tr id="item_banner_<?php echo $banner->Id_banner; ?>">
    <td class="text-left">
        <?php echo $banner->orden; ?>
    </td>
    <td class="text-left">
        <?php if ( $banner->image ) : ?>
            <img src="<?php echo $banner->image; ?>" width="200px">
        <?php endif; ?>
    </td>
    <td class="text-left">
        <?php echo $banner->title; ?>
    </td>
    <td class="text-left">
        <?php echo $banner->text; ?>
    </td>
    <td class="text-left">
        <?php echo $banner->link; ?>
    </td>
    <td class="text-left">
        <?php echo $banner->small; ?>
    </td>
    <td class="shoping__cart__item__update text-center">
        <span onclick="getBannerdata(this);" data-ban="<?php echo $banner->Id_banner; ?>" data-toggle="modal" data-target="#bannerModal" class="icon_pencil-edit" title="Editar"></span>
    </td>
    <td class="shoping__cart__item__close text-center">
        <form class="js-form-banner-delete">
            <input type="hidden" name="id_item" value="<?php echo $banner->Id_banner; ?>">
            <span onclick="$(this).closest('form').submit();" class="icon_close" title="Eliminar"></span>
        </form>
    </td>
</tr>