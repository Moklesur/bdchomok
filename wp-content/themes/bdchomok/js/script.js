(function ($) {
    $(document).ready(function () {

        window.prettyPrint && prettyPrint();
        $(document).on('click', '.main-menu .xs-dropdown-menu', function(e) {
            e.stopPropagation();
        });




        //$('.product-sticky').addClass( 'd-lg-block' );
        $(window).scroll(function() {
            if ($(document).scrollTop() > $(window).height() ) {
                $('.product-sticky').addClass( 'd-block' );
            }
            else {
                $('.product-sticky').removeClass( 'd-block' );
            }
        });


        $('.main-menu .xs-dropdown-menu').parent().hover(function() {
            var menu = $(this).find("ul");
            var menupos = $(menu).offset();
            if (menupos.left + menu.width() > $(window).width()) {
                var newpos = -$(menu).width();
                menu.css({ left: newpos });
            }
        });
        $(document).on('click', '.main-menu .xs-angle-down', function(e) {
            e.preventDefault();
            $(this).parent('a').next().toggle();
        });

        $(document).on('click', '.main-menu .menu-xs-tri-xs', function(e) {
            e.preventDefault();
            $(this).parent('.dropdown-item').toggleClass('has-active');
        });


        if ($(window).width() < 768 ) {
        }
        else {
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
        }

        $('.mobile-account').on( 'click', function (e) {
            e.preventDefault();
            $(this).next().toggle();
        });

        if ($('#back-to-top').length) {
            var scrollTrigger = 1000, /* px*/ backToTop = function () {
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
                    autoplay: true,
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

        /* Brand Logo */
        if (('.logo-item').length) {
            $('.logo-item').each(function () {
                $(this).slick({
                    slidesToShow: 8,
                    autoplay: true,
                    nextArrow: '<i class="icofont-long-arrow-right slider-right arrow-position f-2x"></i>',
                    prevArrow: '<i class="icofont-long-arrow-left arrow-position f-2x"></i>',
                    centerPadding: '0px',
                    centerMode: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 6
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 4
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 3
                            }
                        }]
                });
            });
        }

        /* Slider */
        if (('.bdchomok-slider-js').length) {
            $('.bdchomok-slider-js').each(function () {
                $(this).slick({
                    dots: true,
                    arrows: false,
                    infinite: true,
                    autoplay: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: true
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

            $(".quick-view-modal").modal("show");
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

        // Advance search
        $('.advance-search-tri').bind('input', function(){

            if( $(this).val() == '' ){
                $('.search-content').addClass('active').html('');
                return;
            }

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

                        if( $('.advance-search-tri').val() == '' ){
                            $('.search-content').addClass('active').html('');
                            return;
                        }
                        //console.log( response.output );
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

        $('.site-footer .footer-middle h5').on( 'click', function () {
            $( this ).toggleClass('has-active');
           $( this ).next().slideToggle();
        });

        // Cat filter Js
        // $( 'body' ).on( 'click', '.product-filter-js', function(e) {
        //  e.preventDefault();
        //  var catURL = $( this ).attr('data-cat-id' );
        //  console.log( catURL );
        //
        //  $.ajax({
        //     method: 'POST',
        //      url: js_vars.ajaxurl,
        //      data: {
        //          action: "cat_filter",
        //          cat_ID: catURL
        //      },
        //      //dataType: "json",
        //      success: function (response) {
        //          console.log(response);
        //          response = response.substring(0, response.length - 1);
        //          $('ul.products').html(response);
        //      }
        //  });
        //
        // });
    });

    // Product page sticky header
    $( window ).load( function () {
        var author = $('.author').clone();
        $('.author-pro').append(author);
        console.log( author );
    });

})(jQuery);