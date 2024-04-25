<!-- Modal -->
<?php if ($general->promo_modal != '') : ?>

<div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close modal-promo-banner-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <img src="<?php echo $general->promo_modal; ?>" alt="banner promo">
      </div>
    </div>
  </div>
</div>

<?php endif; ?>