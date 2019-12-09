var jq = jQuery.noConflict();

jq(document).ready(function(){

	// Lightbox /////
	jq("[data-fancybox]").fancybox({
		toolbar: false,
		smallBtn: true
	});

    // slick slider /////
    jq('.gen-slider').slick({
        arrows: false,
        dots: false,
        slidesToShow: 8,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
            {
              breakpoint: 1400,
              settings: {
                slidesToShow: 6,
                slidesToScroll: 2,
                infinite: true
              }
            },
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
                infinite: true
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            }
        ]
    });

    jq('.recent-slider').slick({
        arrows: false,
        dots: false,
        slidesToShow: 5,
        autoplay: true,
        autoplaySpeed: 6000,
        responsive: [
            {
              breakpoint: 1400,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
                infinite: true
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]
    });

}); // Fin document ready


