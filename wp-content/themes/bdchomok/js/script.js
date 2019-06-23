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

        // List category tab
        if ($('#category-list-tab').length) {
            $('#category-list-tab li:first-child a').tab('show');
            $('#category-list-tabContent .tab-pane:first-child').tab('show');
        }

        /* Featured News*/
        if (('.category-filter').length) {
            $('div.category-filter ul.products').each(function () {
                $(this).slick({
                    slidesToShow: 5,
                    autoplay: false,
                    nextArrow: '<i class="icofont-long-arrow-right slider-right arrow-position f-2x"></i>',
                    prevArrow: '<i class="icofont-long-arrow-left arrow-position f-2x"></i>',
                    centerPadding: '0px',
                    centerMode: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2
                        }
                    }]
                });
            });
        }

        // Quick View
        $(document).on('click', '.quick-view', function (e) {
            $(".loading-wrap").removeClass("d-none");
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
                        $(".loading-wrap").addClass("d-none");
                        $('.quick-view-modal .modal-body').html(response.html);
                        $(".quick-view-modal").modal("show");
                    }, 500);
                }
            });
        };


        // Advance search ajax
        $(".search-target .form-control").keyup( function () {
            $(".search-target").addClass('active');
            console.log($(".search-target .form-control").val());
            var stem = $(".search-target .form-control").val();
            $.ajax({
                method: 'POST',
                url: js_vars.ajaxurl,
                data: {
                    action: "advance_search",
                    keyword: $(".search-target .form-control").val()
                },
                dataType: "json",
                async:true,
                success: function (response) {
                    //var res_data = response.output;
                    $('.product-search-content').html(response.output);
                    // $('.mb-0.highlight span').text(stem);
                    $(".search-target").removeClass('active');
                }
            });

        });

        // Quick View
        $(".advance-search").modal("hide");
        $(body).on('click', '.advance-search-tri', function (e) {
            $(".advance-search").modal("show");
        });
        $(body).on('click', '.advance-search .close', function (e) {
            $(".advance-search").modal("hide");
        });
    });

})(jQuery);