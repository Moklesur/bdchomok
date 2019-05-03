(function ($) {
    $(document).ready(function () {

        if ($('#back-to-top').length) {
            var scrollTrigger = 100, /* px*/ backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({scrollTop: 0}, 700);
            });
        }

        /* Featured News*/
        if (('.category-filter').length) {
            $('div.category-filter ul.products').each(function () {
                $(this).slick({
                    slidesToShow: 5,
                    autoplay: false,
                    nextArrow: '<i class="ion-ios-arrow-right slider-right arrow-position f-2x"></i>',
                    prevArrow: '<i class="ion-ios-arrow-left arrow-position f-2x"></i>',
                    centerPadding: '0px',
                    centerMode: true,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }},
                        {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1
                        }
                    }]
                });
            });
        }

        // Quick View
        $(document).on('click', '.quick-view', function (e) {

            var pid = $(this).attr('data-pid');

            load_ajax_product_pp(pid);

            // $(".quick-view-modal").modal("show");
        });

        // Quick View Function
        load_ajax_product_pp = function(pid){
            $.ajax({
                method: 'POST',
                url: js_vars.ajaxurl,
                data: { action: "load_single_product", pid: pid},
                dataType: "json",
                async:false,
                success: function (response) {

                    setTimeout(function() {
                        $('.quick-view-modal .modal-body').html(response.html);
                        $(".quick-view-modal").modal("show");
                    }, 500);
                }
            });
        };


    });

})(jQuery);