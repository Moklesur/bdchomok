(function ($) {
    $(document).ready(function () {

        var toggleAffix = function(affixElement, scrollElement, wrapper) {

            var height = affixElement.outerHeight(),
                top = wrapper.offset().top;

            if (scrollElement.scrollTop() >= top){
                wrapper.height(height);
                affixElement.addClass("affix");
            }
            else {
                affixElement.removeClass("affix");
                wrapper.height('auto');
            }

        };


        $('[data-toggle="affix"]').each(function() {
            var ele = $(this),
                wrapper = $('<div></div>');

            ele.before(wrapper);
            $(window).on('scroll resize', function() {
                toggleAffix(ele, $(this), wrapper);
            });

            // init
            toggleAffix(ele, $(window), wrapper);
        });


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


        var  data = $('.cat-filter').attr('data_limit');
        var show = "";
        if (data !== "" ){
            show = data-1;
        }else{
            show = data;
        }
        /* Featured News*/
        if (('.category-filter').length) {
            $('div.category-filter ul.products').each(function () {
                $(this).slick({
                    slidesToShow: show,
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

        /* Author Slider */
        if (('.author-slider').length) {
            $('.author-slider').each(function () {
                $(this).slick({
                    slidesToShow: 6,
                    autoplay: true,
                    nextArrow: '<i class="icofont-long-arrow-right slider-right arrow-position f-2x"></i>',
                    prevArrow: '<i class="icofont-long-arrow-left arrow-position f-2x"></i>',
                    centerPadding: '0px',
                    centerMode: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3
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

        // Product List Slider
        $( '.on-sale-product .product_list_widget' ).each( function() {
            $( this ).slick( {
                vertical: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                centerPadding: '0px',
                autoplay: true,
                centerMode: true,
                nextArrow: '<i class="ion-ios-arrow-up f-2x"></i>',
                prevArrow: '<i class="ion-ios-arrow-down f-2x"></i>',
                autoplaySpeed: 2000,
                dot: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    }
                ]
            } );
        } );

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




        $('.advance-search-tri').bind('input', function(){
            if ($(this).val() !== null || $(this).val() !== 'undefined') {

                // $(".search-target").addClass('active');
                $.ajax({
                    method: 'POST',
                    url: js_vars.ajaxurl,
                    data: {
                        action: "advance_search",
                        keyword: $(this).val()
                    },
                    dataType: "json",
                    async:true,
                    success: function (response) {
                        //var res_data = response.output;
                        if (response.output != null) {

                            $('.search-content').addClass('active').html(response.output);
                            // $(".search-target").removeClass('active');
                        }else{
                            $('.search-content').removeClass('active');
                            // $(".search-target").removeClass('active');
                        }
                    }
                });
            }

        });


    });

})(jQuery);