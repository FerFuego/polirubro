/*-----------------------
    Product Card Slider
------------------------*/
$(document).ready(function () {
    $('.product-card-slider').each(function () {
        const $slider = $(this);
        const $items = $slider.find('.slider-item');
        const $dots = $slider.find('.dot');
        let currentSlide = 0;

        // Only initialize if there are multiple images
        if ($items.length <= 1) {
            return;
        }

        function showSlide(index) {
            $items.removeClass('active').eq(index).addClass('active');
            $dots.removeClass('active').eq(index).addClass('active');
        }

        $slider.find('.slider-next').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            currentSlide = (currentSlide + 1) % $items.length;
            showSlide(currentSlide);
        });

        $slider.find('.slider-prev').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            currentSlide = (currentSlide - 1 + $items.length) % $items.length;
            showSlide(currentSlide);
        });

        $dots.on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            currentSlide = $(this).data('slide');
            showSlide(currentSlide);
        });
    });
});

/*-----------------------
    Product Detail Gallery
------------------------*/
$(document).ready(function () {
    $('.product__details__pic__slider .thumb-item').on('click', function () {
        const $thumb = $(this);
        const type = $thumb.data('type');
        const src = $thumb.data('src');

        // Update active state
        $('.thumb-item').removeClass('active');
        $thumb.addClass('active');

        if (type === 'image') {
            $('#mainVideo').hide();
            $('#mainImage').attr('src', src).show();
        } else if (type === 'video') {
            $('#mainImage').hide();
            $('#mainVideo').attr('src', src).show()[0].load();
        }
    });
});
