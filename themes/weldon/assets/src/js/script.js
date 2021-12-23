jQuery(function($) {
    $(document).ready(function(){
        const bLazy = new Blazy({
            // Options
        });

        heroPos();
        modalToggle();
        headerNav();
    });

    function modalToggle(){
        if($('.has_modal').length > 0){
            $('.has_modal').click((event)=>{
                if(!$(event.currentTarget).hasClass('active')){
                    var scrollWidth = window.innerWidth - document.documentElement.clientWidth;
                    $(event.currentTarget).find('.work__job-modal, .work__job-mask').fadeIn().css('display', 'flex');
                    $('body').css('width', 'calc(100% - ' + scrollWidth + 'px)');
                    $('body').addClass('no-scroll');
                    $(event.currentTarget).addClass('active');
                }
            });

            $('.work__job-modal-close').click(function(event){
                $(event.currentTarget).parents('.has_modal').find('.work__job-modal, .work__job-mask').fadeOut();
                $('body').removeClass('no-scroll');
                $('body').css('width', 'auto');
                setTimeout(function(){
                    $(event.currentTarget).parents('.has_modal').removeClass('active');
                },1000);
            })
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
})