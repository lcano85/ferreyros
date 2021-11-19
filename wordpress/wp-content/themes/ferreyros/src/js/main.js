// Imports
//=require bootstrap/dist/js/bootstrap.bundle.js
//=require swiper/swiper-bundle.js

jQuery(function($){

    var ferreyrosItemCount = $('.ferreyros__banner .banner__item').length;

    if( ferreyrosItemCount > 1 ){
        $('.ferreyros__banner .swiper-pagination').removeClass('d-none');
        
        var ferreyrosBanner = new Swiper('.ferreyros__banner', {
            loop: true,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
              },
            pagination: {
              el: '.swiper-pagination',
            },
          });
    }

    $('.hamburger__list').click(function(){
        $(this).toggleClass('active');
        $('.menu-principal').toggleClass('left-open');
        $('body').toggleClass('overflow-hidden');     
    });

    $('.ferreyros__header .ferreyros__access .button').click(function(){
        var width = $(window).width();
        if (width < 992) {     
            $('body').toggleClass('overflow-hidden');
        }else{
            $('body').removeClass('overflow-hidden');
        }
        return false;
    });
    
    $('.ferreyros__header .menu-principal .menu-item-has-children > a').on('click', function(e){
        var width = $(window).width();
        if (width < 992) {            
            e.preventDefault();
            var $this = $(this);              
            if ($this.next().hasClass('show')) {
                $this.removeClass('active');
                $this.next().removeClass('show');
                $this.next().slideUp(350);
                
            } else {
                $this.parent().parent().find('li a').removeClass('active');
                $this.parent().parent().find('li .sub-menu').removeClass('show');
                $this.parent().parent().find('li .sub-menu').slideUp(350);
                $this.toggleClass('active');
                $this.next().toggleClass('show');
                $this.next().slideToggle(350);                
            }
            return false;
        }
    });

    $('.menu-item-has-children .menu-item-has-children > a').on('click', function(e){
        e.preventDefault();
        $(this).parent().find('.sub-menu').toggleClass('active');
    })

    //Buscador
    $('html').on('click', function(){
        $('.ferreyros__search').removeClass('active');
        $('.ferreyros__access .button').prev().removeClass('active');
    });
    $('.ferreyros__search').on('click', function(e){
        e.stopPropagation();
        $(this).addClass('active');
        $(this).find('.form-control').focus();
    });

    $('.ferreyros__access .button').on('click', function(e){
        e.preventDefault();
        $(this).parent().toggleClass('active');
    });
});