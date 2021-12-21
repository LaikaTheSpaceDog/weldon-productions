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
                $(event.currentTarget).find('.work__job-modal, .work__job-mask').toggleClass('active');
                $('body').toggleClass('no-scroll');
            });
        }
    }
})