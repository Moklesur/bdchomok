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
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {

                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {
                $(".product-card-model").modal("show");


                modelData(response.fragments['div.widget_shopping_cart_content']);

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

    function modelData( response) {
        let  product, title, src, price;

        console.log(response);


            $("#popup_cart_info").find('.cart_info').append(response);




        // if (data.product_id ){
        //      product = $('.post-'+data.product_id);
        //      title = product.find('.woocommerce-loop-product__title').html();
        //      src = product.find('img').attr('src');
        //      price = product.find('.price').html();
        //     // console.log(price);
        //     // $("#popup_cart_info").find('.cart_info').append(response);
        //     $("#popup_cart_info").find('.cart_info').append(
        //         '<div class="single-product" style="padding: 30px"> ' +
        //         '<img src='+src+' alt="">' +
        //         '<h3>'+title+'</h3>' +
        //         '<h4>Quantity:'+data.quantity+'</h4>  <span>price:</span> '+
        //         price+'</div>');
        // }
    }

})(jQuery);