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

    });

})(jQuery);