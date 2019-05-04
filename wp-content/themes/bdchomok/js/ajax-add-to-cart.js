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
                    $('.product-card-model .modal-body').html(response.html);
                    $(".product-card-model").modal("show");
                }, 500);

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


})(jQuery);

