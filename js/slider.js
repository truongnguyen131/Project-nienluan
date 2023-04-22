 // slider
 $(document).ready(function() {
     $(".image-slider").slick({
         slidesToShow: 4,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 1000,
         infinite: true,
         arrows: true,
         draggable: false,
         prevArrow: `<button type='button' class='slick-prev slick-arrow'><i class='bx bx-chevron-left'></i></button>`,
         nextArrow: `<button type='button' class='slick-next slick-arrow'><i class='bx bx-chevron-right'></i></button>`,
         dots: true,
         responsive: [{
                 breakpoint: 1025,
                 settings: {
                     slidesToShow: 3,
                 },
             }, {
                 breakpoint: 769,
                 settings: {
                     slidesToShow: 2,
                 },
             },
             {
                 breakpoint: 480,
                 settings: {
                     slidesToShow: 1,
                     arrows: false,
                     infinite: false,
                 },
             },
         ],
     });
 });