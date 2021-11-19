/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */
(function ($) {

    $(document).ready(function(){
        var bLazy = new Blazy({
            // Options
        });
        
        headerScroll();
    })

    function headerScroll(){
        $('.l-header .menu-item a').click(function(e){
            e.preventDefault();
            var id = $(this).attr('href');
            if(id == '#about-me'){
                var speed = 500;
            } else if (id == '#current-work'){
                var speed = 1000;
            } else if (id == '#previous-work'){
                var speed = 1500;
            } else if (id == '#contact-me'){
                var speed = 2000;
            }
            $([document.documentElement, document.body]).animate({
                scrollTop: $(id).offset().top
            }, speed, 'easeInOutSine');
        })
    }


})(jQuery);
