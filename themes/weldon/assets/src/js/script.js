jQuery(function($) {
    $(document).ready(function(){
        const bLazy = new Blazy({
            // Options
        });

        modalToggle();
    });

    function modalToggle(){
        if($('.has_modal').length > 0){
            $('.has_modal').click((event)=>{
                var scrollWidth = window.innerWidth - document.documentElement.clientWidth;
                $(event.currentTarget).find('.work__job-modal, .work__job-mask').fadeToggle();
                $('body').css('width', 'calc(100% - ' + scrollWidth + 'px)');
                $('body').toggleClass('no-scroll');
            });
        }
    }
})