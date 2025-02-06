jQuery(document).ready(function ($) {
    var emailInput = $('.wpcf7-form-control.wpcf7-email');
    var submitButton = $('.submit-button');

    function checkEmailAndEnableSubmit() {
        var emailValue = emailInput.val().trim();
        if (emailValue === '') {
            submitButton.prop('disabled', true);
        } else {
            submitButton.prop('disabled', false);
        }
    }

    emailInput.on('input', function () {
        checkEmailAndEnableSubmit();
    });

    submitButton.on('click', function (e) {
        checkEmailAndEnableSubmit();

        // Hiển thị modal khi nhấn nút submit
        if(!$('.wpcf7-not-valid-tip').length){
            $('#myModal').modal('show');
        }
    });

    // Kiểm tra trạng thái ban đầu của nút submit
    checkEmailAndEnableSubmit();


    var savedTab = localStorage.getItem('selectedTab');
    if (savedTab) {
        $('#' + savedTab).prop('checked', true);
    }

    // Add event listeners to save tab state
    $('#tab-1').on('change', function () {
        if ($('#tab-1').is(':checked')) {
            localStorage.setItem('selectedTab', 'tab-1');
        }
    });

    $('#tab-2').on('change', function () {
        if ($('#tab-2').is(':checked')) {
            localStorage.setItem('selectedTab', 'tab-2');
        }
    });

    var url = window.location.href;
    $('.nav-link').each(function () {
        if (url === (this.href)) {
            $(this).addClass('active');
        }
    });

    var currentUrl = window.location.href;

    $('.wc-block-product-categories-list-item a').each(function () {
        var itemUrl = $(this).attr('href');
        if (currentUrl === itemUrl) {
            $(this).parent().addClass('active');
        }
    });

    if ($('.woocommerce-error').length) {
        $('.woocommerce-error li[data-id]').each(function () {
            var dataId = $(this).attr('data-id');
            console.log("data-id:", dataId);

            $('#' + dataId).addClass('input-error');
        });
    }
    function updateQuantityButtons() {
        $('.details-product .quantity').each(function () {
            var $this = $(this);
            if (!$this.find('.plus, .minus').length) {
                $this.prepend('<button type="button" class="minus">-</button>');
                $this.append('<button type="button" class="plus">+</button>');
            }
        });

        $(document).on('click', '.plus', function () {
            var $input = $(this).siblings('input.qty');
            var val = parseInt($input.val());
            var max = parseInt($input.attr('max'));
            if (val < max || isNaN(max)) {
                $input.val(val + 1).change();
            }
        });

        $(document).on('click', '.minus', function () {
            var $input = $(this).siblings('input.qty');
            var val = parseInt($input.val());
            var min = parseInt($input.attr('min'));
            if (val > min || isNaN(min)) {
                $input.val(val - 1).change();
            }
        });
    }

    updateQuantityButtons();

    // For dynamically loaded products (e.g., via AJAX)
    $(document.body).on('updated_wc_div', updateQuantityButtons);


    $('#slider').nivoSlider({
        effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown, random'
        slices: 15,                     // For slice animations
        boxCols: 8,                     // For box animations
        boxRows: 4,                     // For box animations
        animSpeed: 1000,                 // Slide transition speed
        pauseTime: 4000,                // How long each slide will show
        startSlide: 0,                  // Set starting Slide (0 index)
        directionNav: true,             // Next & Prev navigation
        controlNav: true,               // 1,2,3... navigation
        controlNavThumbs: false,        // Use thumbnails for Control Nav
        pauseOnHover: true,             // Stop animation while hovering
        manualAdvance: false,           // Force manual transitions
        prevText: 'Prev',               // Prev directionNav text
        nextText: 'Next',               // Next directionNav text
        randomStart: false,             // Start on a random slide
        beforeChange: function () { },     // Triggers before a slide transition
        afterChange: function () { },      // Triggers after a slide transition
        slideshowEnd: function () { },     // Triggers after all slides have been shown
        lastSlide: function () { },        // Triggers when last slide is shown
        afterLoad: function () { }         // Triggers when slider has loaded
    });
});


var swiper = new Swiper('.swiper', {
    slidesPerView: 1,
    spaceBetween: 10,
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 20
        },
        640: {
            slidesPerView: 4,
            spaceBetween: 20
        },
        1240: {
            slidesPerView: 5,
            spaceBetween: 20
        }
    },
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    loop: true,
    autoplay: {
        delay: 3000,
    },
    pagination: {
        el: ".swiper-pagination",
    },
});



jQuery(document).ready(function ($) {

    jQuery(document).on('input','#wc-block-components-totals-coupon__input-0',function(){
        if($('.wc-block-components-checkout-step--disabled').length >0){
            $('.wc-block-components-totals-coupon__button').prop('disabled', true);
        }
    })

    $('.wc-block-components-checkout-step--disabled input, .wc-block-components-checkout-step--disabled textarea').prop('readonly', true);
});
