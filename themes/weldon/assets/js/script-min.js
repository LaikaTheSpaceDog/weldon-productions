jQuery(function(e){e(document).ready(function(){new Blazy({});e(".has_modal").length>0&&(e(".has_modal").click(o=>{if(!e(o.currentTarget).hasClass("active")){var r=window.innerWidth-document.documentElement.clientWidth;e(o.currentTarget).find(".work__job-modal, .work__job-mask").fadeIn().css("display","flex"),e("body").css("width","calc(100% - "+r+"px)"),e("body").addClass("no-scroll"),e(o.currentTarget).addClass("active"),e(o.currentTarget).find(".single-job__gallery.modal-gallery").length>0&&e(o.currentTarget).find(".single-job__gallery.modal-gallery").slick({autoplay:!0,autoplaySpeed:5e3,infinite:!0,fade:!0,prevArrow:e(o.currentTarget).find(".modal-controls .single-job__controls-prev"),nextArrow:e(o.currentTarget).find(".modal-controls .single-job__controls-next")})}}),e(".work__job-modal-close").click(function(o){e(o.currentTarget).parents(".has_modal").find(".work__job-modal, .work__job-mask").fadeOut(),e("body").removeClass("no-scroll"),e("body").css("width","auto"),setTimeout(function(){e(o.currentTarget).parents(".has_modal").removeClass("active")},1e3),e(o.currentTarget).parents(".has_modal").find(".single-job__gallery.modal-gallery").slick("unslick")})),e(".menu-item").click(function(o){o.preventDefault();let r=e(o.currentTarget).find("a").attr("href");e("html, body").animate({scrollTop:e(r).offset().top-20},1e3,"easeInOutCubic")}),function(){e("#current-work .single-job__gallery:not(.modal-gallery)").length>0&&e("#current-work .single-job__gallery:not(.modal-gallery)").slick({autoplay:!0,autoplaySpeed:5e3,infinite:!0,fade:!0,prevArrow:e("#current-work .single-job__controls-prev"),nextArrow:e("#current-work .single-job__controls-next")});e("#previous-work .single-job__gallery:not(.modal-gallery)").length>0&&e("#previous-work .single-job__gallery:not(.modal-gallery)").slick({autoplay:!0,autoplaySpeed:5e3,infinite:!0,fade:!0,prevArrow:e("#previous-work .single-job__controls-prev"),nextArrow:e("#previous-work .single-job__controls-next")})}(),e(".hero .hero__logo").length>0&&(e(".l-header").addClass("visible"),e(".hero .hero__logo").addClass("visible")),function(){let o=e(".nav").outerHeight()+parseInt(e(".nav").css("margin-top"))+parseInt(e(".nav").css("margin-bottom"));e(".hero").css("top",-o+"px")}()})});