jQuery(function($){

    var fred_noticias_item = $('.noticias__list .noticias__item').length;
    
    
    
    $(window).on('resize', function(){

        if(fred_noticias_item > 3 && $(window).width() <= 1190){
            $('.fred__page--noticias .swiper-pagination').removeClass('d-none');
        }else if(fred_noticias_item > 2 && $(window).width() <= 992){
            $('.fred__page--noticias .swiper-pagination').removeClass('d-none');
        }else if(fred_noticias_item > 1 && $(window).width() <= 768){
            $('.fred__page--noticias .swiper-pagination').removeClass('d-none');
        }else{
            $('.fred__page--noticias .swiper-pagination').addClass('d-none');
        }
    });
    $(window).resize();

    if(fred_noticias_item > 3 ){
        $('.swiper-button-next').removeClass('d-none');
        $('.swiper-button-prev').removeClass('d-none');
    }

    var swiper = new Swiper(".fred__page--noticias .noticias__content", {
        slidesPerView: 1,
        spaceBetween: 24,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
              slidesPerView: 2,
            },
            992: {
              slidesPerView: 3,
            },
        },
    });

});
