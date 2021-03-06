jQuery(function($) {
    $(document).ready(function(){
        const bLazy = new Blazy({
            // Options
        });

        modalToggle();
        headerNav();
        jobsSliders();
        logoFade();
        heroPos();
        controls();
        singleJobCopyBody();
    });

    $(window).resize(function(){
        controls();
    })

    $('.has_modal').click(function(){
        setTimeout(function(){
            controls();
            singleJobCopyBody();
        },100)
    })

    function modalToggle(){
        if($('.has_modal').length > 0){
            $('.has_modal').click((event)=>{
                if(!$(event.currentTarget).hasClass('active')){
                    var scrollWidth = window.innerWidth - document.documentElement.clientWidth;
                    $(event.currentTarget).find('.work__job-modal, .work__job-mask').fadeIn().css('display', 'flex');
                    $('body').css('width', 'calc(100% - ' + scrollWidth + 'px)');
                    $('body').addClass('no-scroll');
                    $(event.currentTarget).addClass('active');
                    if($(event.currentTarget).find('.single-job__gallery.modal-gallery').length > 0){
                        $(event.currentTarget).find('.single-job__gallery.modal-gallery').slick({
                            autoplay: true,
                            autoplaySpeed: 5000,
                            infinite: true,
                            fade: true,
                            prevArrow:  $(event.currentTarget).find('.modal-controls .single-job__controls-prev'),
                            nextArrow:  $(event.currentTarget).find('.modal-controls .single-job__controls-next'),
                        });
                    }
                }
                $('.work__job-modal-close').click(function(event){
                    $(event.currentTarget).parents('.has_modal').find('.work__job-modal, .work__job-mask').fadeOut();
                    $('body').removeClass('no-scroll');
                    $('body').css('width', 'auto');
                    $(event.currentTarget).parents('.has_modal').find('.single-job__gallery.modal-gallery').slick('unslick');
                    setTimeout(function(){
                        $(event.currentTarget).parents('.has_modal').removeClass('active');
                    },500);
                });
            });
        }
    }

    function heroPos(){
        let headerHeight =  $('.nav').outerHeight() +  parseInt($('.nav').css('margin-top')) + parseInt($('.nav').css('margin-bottom'));
        $('.hero').css('top', -headerHeight + 'px');
    }

    function headerNav(){
        $('.menu-item').click(function(e){
            e.preventDefault();
            let id = $(e.currentTarget).find('a').attr('href');
            $('html, body').animate({
                scrollTop: $(id).offset().top - 20
            }, 1000, 'easeInOutCubic');
        })
    }

    function jobsSliders(){
        if($('#current-work .single-job__gallery:not(.modal-gallery)').length > 0){
            $('#current-work .single-job__gallery:not(.modal-gallery)').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                fade: true,
                prevArrow: $('#current-work .single-job__controls-prev'),
                nextArrow: $('#current-work .single-job__controls-next')
            });
        }

        if($('#previous-work .single-job__gallery:not(.modal-gallery)').length > 0){
            $('#previous-work .single-job__gallery:not(.modal-gallery)').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                fade: true,
                prevArrow: $('#previous-work .single-job__controls-prev'),
                nextArrow: $('#previous-work .single-job__controls-next')
            });
        }
    }

    function logoFade(){
        $('.l-header').addClass('visible');

        if($('.hero .hero__logo').length > 0){
            $('.hero .hero__logo').addClass('visible');
        }
    }

    function controls(){
        $('.single-job__controls').each(function(){
            let top = $(this).prev().outerHeight() - $(this).outerHeight();
            $(this).css('top', top);
        });
    }

    function singleJobCopyBody(){
        $('.single-job__copy-body').each(function(){
            let height = $(this).prev().outerHeight();
            $(this).css('height', 'calc(100% - ' + height + 'px)');
        })
    }
});