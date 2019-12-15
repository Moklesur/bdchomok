(function ($) {

    $(document).on('click', '.ajax_add_to_cart', function (e) {
        e.preventDefault();

        var $thisbutton = $(this),
            product_sku = $thisbutton.attr('data-product_sku'),
            product_qty =$thisbutton.attr('data-quantity'),
            product_id = $thisbutton.attr('data-product_id'),
            variation_id =$thisbutton.attr('data-variation_id');

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: product_sku,
            quantity: product_qty,
            variation_id: variation_id,
        };

        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

        $(".loading-wrap").removeClass("d-none");

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: { action: "load_add_cart_info_product", pid: product_id},
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {

                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {
                setTimeout(function() {
                        $(".loading-wrap").addClass("d-none");
                        var model = $(".product-card-model");
                        $('.product-card-model .modal-body').html(response.html);
                        model.modal("show");
                        var slider = model.find('.rand-slider');
                        slider.slick({
                            dots: false,
                            infinite: true,
                            arrows:true,
                            speed: 300,
                            autoplay: true,
                            autoplaySpeed: 2000,
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='icofont-long-arrow-left f-2x slick-arrow' aria-hidden='true'></i></button>",
                            nextArrow:"<button type='button' class='slick-next pull-right'><i class='icofont-long-arrow-right slider-right f-2x slick-arrow' aria-hidden='true'></i></button>",
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 1,
                                        infinite: true,
                                        dots: false,
                                    }
                                },
                                {
                                    breakpoint: 600,
                                    settings: {
                                        slidesToShow: 2,
                                        slidesToScroll: 2,
                                        dots: false,
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                        dots: false,
                                    }
                                }
                            ]
                        });

                    }, 1000);

                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });

        return false;
    });


    $(document).on('click', '.single_add_to_cart_button', function (e) {
        e.preventDefault();

        var $thisbutton = $(this),
            $form = $thisbutton.closest('form.cart'),
            id = $thisbutton.val(),
            product_qty = $form.find('input[name=quantity]').val() || 1,
            product_id = $form.find('input[name=product_id]').val() || id,
            variation_id = $form.find('input[name=variation_id]').val() || 0;

        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };

        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

        $(".loading-wrap").removeClass("d-none");

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: { action: "load_add_cart_info_product", pid: product_id},
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {

                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {
                setTimeout(function() {
                    $(".loading-wrap").addClass("d-none");
                    var model = $(".product-card-model");
                    $('.product-card-model .modal-body').html(response.html);
                    model.modal("show");
                    var slider = model.find('.rand-slider');
                    slider.slick({
                        dots: false,
                        infinite: true,
                        arrows:true,
                        speed: 300,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='icofont-long-arrow-left f-2x slick-arrow' aria-hidden='true'></i></button>",
                        nextArrow:"<button type='button' class='slick-next pull-right'><i class='icofont-long-arrow-right slider-right f-2x slick-arrow' aria-hidden='true'></i></button>",
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: false,
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                    dots: false,
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    dots: false,
                                }
                            }
                        ]
                    });

                }, 1000);

                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                }
            },
        });

        return false;
    });

    $('.modal').on('shown.bs.modal', function (e) {
        $(".product-card-model").find('.rand-slider').slick("setPosition", 0);
    });





})(jQuery);

