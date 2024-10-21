(function ($) {
    "use strict";
    $.fn.meanmenu = function (options) {
        var defaults = {
            meanMenuTarget: jQuery(this),
            meanMenuContainer: '.mobile-menu-area .container',
            meanMenuClose: "X",
            meanMenuCloseSize: "18px",
            meanMenuOpen: "<span /><span /><span />",
            meanRevealPosition: "right",
            meanRevealPositionDistance: "0",
            meanRevealColour: "",
            meanScreenWidth: "991",
            meanNavPush: "",
            meanShowChildren: true,
            meanExpandableChildren: true,
            meanExpand: "+",
            meanContract: "-",
            meanRemoveAttrs: false,
            onePage: false,
            meanDisplay: "block",
            removeElements: ""
        };
        options = $.extend(defaults, options);
        
        var isMobile = /iPhone|iPad|iPod|Android|Blackberry|Windows Phone/i.test(navigator.userAgent);
        var meanMenuExist = false;

        function meanCentered(meanRevealClass) {
            if (options.meanRevealPosition === "center") {
                var meanCenter = (($(window).width() / 2) - 22) + "px";
                $(meanRevealClass).css("left", meanCenter);
            }
        }

        function meanOriginal() {
            $('.mean-bar, .mean-push').remove();
            $(options.meanMenuContainer).removeClass("mean-container");
            $(options.meanMenuTarget).css('display', options.meanDisplay);
            meanMenuExist = false;
            $(options.removeElements).removeClass('mean-remove');
        }

        function showMeanMenu() {
            if ($(window).width() > options.meanScreenWidth) {
                meanOriginal();
                return;
            }

            if (!meanMenuExist) {
                meanMenuExist = true;
                $(options.meanMenuContainer).addClass("mean-container");
                $('.mean-container').prepend('<div class="mean-bar"><a href="#nav" class="meanmenu-reveal" style="background:' + options.meanRevealColour + ';color:' + options.meanRevealColour + ';' + (options.meanRevealPosition === 'right' ? 'right' : 'left') + ':' + options.meanRevealPositionDistance + ';">' + options.meanMenuOpen + '</a><nav class="mean-nav"></nav></div>');

                var meanMenuContents = $(options.meanMenuTarget).html();
                $('.mean-nav').html(meanMenuContents);
                
                if (options.meanRemoveAttrs) {
                    $('.mean-nav ul, .mean-nav ul *').removeAttr("class").removeAttr("id");
                }

                $(options.meanMenuTarget).before('<div class="mean-push" />');
                $('.mean-push').css("margin-top", options.meanNavPush);
                $(options.meanMenuTarget).hide();
                $(".meanmenu-reveal").show();

                $('.mean-nav ul').hide();

                if (options.meanShowChildren && options.meanExpandableChildren) {
                    $('.mean-nav ul ul').each(function () {
                        if ($(this).children().length) {
                            $(this).parent().append('<a class="mean-expand" href="#" style="font-size: ' + options.meanMenuCloseSize + '">' + options.meanExpand + '</a>');
                        }
                    });
                    $('.mean-expand').on("click", function (e) {
                        e.preventDefault();
                        $(this).text($(this).hasClass("mean-clicked") ? options.meanExpand : options.meanContract);
                        $(this).prev('ul').slideToggle(300);
                        $(this).toggleClass("mean-clicked");
                    });
                } else {
                    $('.mean-nav ul ul').toggle(options.meanShowChildren);
                }

                $('.meanmenu-reveal').on("click", function (e) {
                    e.preventDefault();
                    $('.mean-nav ul:first').slideToggle();
                    $(this).toggleClass("meanclose").html($(this).hasClass("meanclose") ? options.meanMenuClose : options.meanMenuOpen);
                });

                if (options.onePage) {
                    $('.mean-nav ul > li > a:first-child').on("click", function () {
                        $('.mean-nav ul:first').slideUp();
                        $('.meanmenu-reveal').toggleClass("meanclose").html(options.meanMenuOpen);
                    });
                }
            }
        }

        $(window).resize(function () {
            meanCentered(".meanmenu-reveal");
            showMeanMenu();
        });

        return this.each(function () {
            meanCentered(".meanmenu-reveal");
            showMeanMenu();
        });
    };
})(jQuery);
/*------sticky----*/


(function(factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }
}(function($) {
    var defaults = {
        topSpacing: 0,
        bottomSpacing: 0,
        className: 'is-sticky',
        wrapperClassName: 'sticky-wrapper',
        center: false,
        getWidthFrom: '',
        widthFromWrapper: true,
        responsiveWidth: false,
        zIndex: '999999'
    };

    var $window = $(window),
        $document = $(document),
        sticked = [],
        windowHeight = $window.height();

    function scroller() {
        var scrollTop = $window.scrollTop(),
            documentHeight = $document.height(),
            dwh = documentHeight - windowHeight,
            extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

        sticked.forEach(function(s) {
            var elementTop = s.stickyWrapper.offset().top,
                etse = elementTop - s.topSpacing - extra;

            s.stickyWrapper.css('height', s.stickyElement.outerHeight());

            if (scrollTop <= etse) {
                if (s.currentTop !== null) {
                    s.stickyElement.css({ 'width': '', 'position': '', 'top': '', 'z-index': '' });
                    s.stickyElement.parent().removeClass(s.className);
                    s.currentTop = null;
                }
            } else {
                var newTop = Math.max(documentHeight - s.stickyElement.outerHeight() - s.topSpacing - s.bottomSpacing - scrollTop - extra, s.topSpacing);

                if (s.currentTop !== newTop) {
                    var newWidth = s.getWidthFrom ? $(s.getWidthFrom).width() : s.widthFromWrapper ? s.stickyWrapper.width() : s.stickyElement.width();
                    s.stickyElement.css({ 'width': newWidth, 'position': 'fixed', 'top': newTop, 'z-index': s.zIndex });
                    s.stickyElement.parent().addClass(s.className);
                    s.currentTop = newTop;
                }

                var stickyWrapperContainer = s.stickyWrapper.parent(),
                    unstick = (s.stickyElement.offset().top + s.stickyElement.outerHeight() >= stickyWrapperContainer.offset().top + stickyWrapperContainer.outerHeight()) && (s.stickyElement.offset().top <= s.topSpacing);

                if (unstick) {
                    s.stickyElement.css({ 'position': 'absolute', 'top': '', 'bottom': 0, 'z-index': '' });
                }
            }
        });
    }

    function resizer() {
        windowHeight = $window.height();
        sticked.forEach(function(s) {
            var newWidth = s.getWidthFrom && s.responsiveWidth ? $(s.getWidthFrom).width() : s.widthFromWrapper ? s.stickyWrapper.width() : s.stickyElement.width();
            if (newWidth != null) s.stickyElement.css('width', newWidth);
        });
    }

    var methods = {
        init: function(options) {
            return this.each(function() {
                var o = $.extend({}, defaults, options),
                    stickyElement = $(this),
                    stickyWrapper = $('<div>').attr('id', stickyElement.attr('id') ? stickyElement.attr('id') + '-' + o.wrapperClassName : o.wrapperClassName).addClass(o.wrapperClassName);

                stickyElement.wrapAll(stickyWrapper);
                stickyWrapper = stickyElement.parent();

                if (o.center) stickyWrapper.css({ width: stickyElement.outerWidth(), marginLeft: "auto", marginRight: "auto" });
                if (stickyElement.css("float") === "right") stickyElement.css({ "float": "none" }).parent().css({ "float": "right" });

                o.stickyElement = stickyElement;
                o.stickyWrapper = stickyWrapper;
                o.currentTop = null;

                sticked.push(o);

                setWrapperHeight(stickyElement);
                setupChangeListeners(stickyElement);
            });
        },
        setWrapperHeight: function(stickyElement) {
            var stickyWrapper = $(stickyElement).parent();
            if (stickyWrapper) stickyWrapper.css('height', $(stickyElement).outerHeight());
        },
        setupChangeListeners: function(stickyElement) {
            if (window.MutationObserver) {
                new MutationObserver(function(mutations) {
                    if (mutations[0].addedNodes.length || mutations[0].removedNodes.length) methods.setWrapperHeight(stickyElement);
                }).observe(stickyElement, { subtree: true, childList: true });
            }
        },
        update: scroller,
        unstick: function() {
            return this.each(function() {
                var that = this,
                    unstickyElement = $(that);

                for (var i = sticked.length - 1; i >= 0; i--) {
                    if (sticked[i].stickyElement.get(0) === that) {
                        sticked.splice(i, 1);
                        unstickyElement.unwrap().css({ 'width': '', 'position': '', 'top': '', 'float': '', 'z-index': '' });
                    }
                }
            });
        }
    };

    if (window.addEventListener) {
        window.addEventListener('scroll', scroller, false);
        window.addEventListener('resize', resizer, false);
    } else if (window.attachEvent) {
        window.attachEvent('onscroll', scroller);
        window.attachEvent('onresize', resizer);
    }

    $.fn.sticky = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.sticky');
        }
    };

    $.fn.unstick = function(method) {
        return this.each(function() {
            methods.unstick.apply(this, arguments);
        });
    };

    $(function() {
        setTimeout(scroller, 0);
    });

    function setWrapperHeight(stickyElement) {
        var stickyWrapper = $(stickyElement).parent();
        if (stickyWrapper) stickyWrapper.css('height', $(stickyElement).outerHeight());
    }

    function setupChangeListeners(stickyElement) {
        if (window.MutationObserver) {
            new MutationObserver(function(mutations) {
                if (mutations[0].addedNodes.length || mutations[0].removedNodes.length) setWrapperHeight(stickyElement);
            }).observe(stickyElement, { subtree: true, childList: true });
        }
    }
}));
/*------jqueryScrollUp-------*/



!function(l,o,e){"use strict";l.fn.scrollUp=function(o){l.data(e.body,"scrollUp")||(l.data(e.body,"scrollUp",!0),l.fn.scrollUp.init(o))},l.fn.scrollUp.init=function(r){var s,t,c,i,n,a,d,p=l.fn.scrollUp.settings=l.extend({},l.fn.scrollUp.defaults,r),f=!1;switch(d=p.scrollTrigger?l(p.scrollTrigger):l("<a/>",{id:p.scrollName,href:"#top"}),p.scrollTitle&&d.attr("title",p.scrollTitle),d.appendTo("body"),p.scrollImg||p.scrollTrigger||d.html(p.scrollText),d.css({display:"none",position:"fixed",zIndex:p.zIndex}),p.activeOverlay&&l("<div/>",{id:p.scrollName+"-active"}).css({position:"absolute",top:p.scrollDistance+"px",width:"100%",borderTop:"1px dotted"+p.activeOverlay,zIndex:p.zIndex}).appendTo("body"),p.animation){case"fade":s="fadeIn",t="fadeOut",c=p.animationSpeed;break;case"slide":s="slideDown",t="slideUp",c=p.animationSpeed;break;default:s="show",t="hide",c=0}i="top"===p.scrollFrom?p.scrollDistance:l(e).height()-l(o).height()-p.scrollDistance,n=l(o).scroll(function(){l(o).scrollTop()>i?f||(d[s](c),f=!0):f&&(d[t](c),f=!1)}),p.scrollTarget?"number"==typeof p.scrollTarget?a=p.scrollTarget:"string"==typeof p.scrollTarget&&(a=Math.floor(l(p.scrollTarget).offset().top)):a=0,d.click(function(o){o.preventDefault(),l("html, body").animate({scrollTop:a},p.scrollSpeed,p.easingType)})},l.fn.scrollUp.defaults={scrollName:"scrollUp",scrollDistance:300,scrollFrom:"top",scrollSpeed:300,easingType:"linear",animation:"fade",animationSpeed:200,scrollTrigger:!1,scrollTarget:!1,scrollText:"Scroll to top",scrollTitle:!1,scrollImg:!1,activeOverlay:!1,zIndex:2147483647},l.fn.scrollUp.destroy=function(r){l.removeData(e.body,"scrollUp"),l("#"+l.fn.scrollUp.settings.scrollName).remove(),l("#"+l.fn.scrollUp.settings.scrollName+"-active").remove(),l.fn.jquery.split(".")[1]>=7?l(o).off("scroll",r):l(o).unbind("scroll",r)},l.scrollUp=l.fn.scrollUp}(jQuery,window,document);

/* ------ Custom Scroll ------ */
(function ($) {
	"use strict";
   
	   
			   $(window).on("load",function(){
				   $(".message-menu, .notification-menu, .comment-scrollbar, .notes-menu-scrollbar, .project-st-menu-scrollbar, .report-graph-scroll, .report-graph-scroll2").mCustomScrollbar({
					   axis:"x",
					   axis:"y",
					   autoHideScrollbar: true,
					   scrollbarPosition: "outside",
					   theme:"light-1"
					   
				   });
				   $(".timeline-scrollbar").mCustomScrollbar({
					   setHeight:636,
					   autoHideScrollbar: true,
					   scrollbarPosition: "outside",
					   theme:"light-1"
					   
				   });
				   $(".project-list-scrollbar").mCustomScrollbar({
					   setHeight:636,
					   theme:"light-2"
				   });
				   $(".messages-scrollbar").mCustomScrollbar({
					   setHeight:503,
					   autoHideScrollbar: true,
					   scrollbarPosition: "outside",
					   theme:"light-1"
				   });
				   $(".chat-scrollbar").mCustomScrollbar({
					   setHeight:250,
					   theme:"light-2"
				   });
				   $(".widgets-chat-scrollbar").mCustomScrollbar({
					   setHeight:335,
					   autoHideScrollbar: true,
					   scrollbarPosition: "outside",
					   theme:"light-1"
				   });
				   $(".widgets-todo-scrollbar").mCustomScrollbar({
					   setHeight:322,
					   autoHideScrollbar: true,
					   scrollbarPosition: "outside",
					   theme:"light-1"
				   });
				   $(".user-profile-scrollbar").mCustomScrollbar({
					   setHeight:1820,
					   autoHideScrollbar: true,
					   scrollbarPosition: "outside",
					   theme:"light-1"
				   });
			   });
			   
	
   })(jQuery); 



   (function ($) {
	"use strict";
   
	   /*----------------------------
		jQuery MeanMenu
	   ------------------------------ */
	   jQuery('nav#dropdown').meanmenu();	
   
   
	   $('#myTab a').on('click', function (e) {
			 e.preventDefault()
			 $(this).tab('show')
		   });
		   $('#myTab3 a').on('click', function (e) {
			 e.preventDefault()
			 $(this).tab('show')
		   });
		   $('#myTab4 a').on('click', function (e) {
			 e.preventDefault()
			 $(this).tab('show')
		   });
		   $('#myTabedu1 a').on('click', function (e) {
			 e.preventDefault()
			 $(this).tab('show')
		   });
   
		 $('#single-product-tab a').on('click', function (e) {
			 e.preventDefault()
			 $(this).tab('show')
		   });
	   
	   $('[data-toggle="tooltip"]').tooltip(); 
	   
	   $('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
		});
	   // Collapse ibox function
	   $('#sidebar ul li').on('click', function () {
		   var button = $(this).find('i.fa.indicator-mn');
		   button.toggleClass('fa-plus').toggleClass('fa-minus');
		   
	   });
	   /*-----------------------------
		   Menu Stick
	   ---------------------------------*/
	   $(".sicker-menu").sticky({topSpacing:0});
		   
	   $('#sidebarCollapse').on('click', function () {
		   $("body").toggleClass("mini-navbar");
		   SmoothlyMenu();
	   });
	   $(document).on('click', '.header-right-menu .dropdown-menu', function (e) {
			 e.stopPropagation();
	   });
	   /*----------------------------
		price-slider active
	   ------------------------------ */  
		 $( "#slider-range" ).slider({
		  range: true,
		  min: 40,
		  max: 600,
		  values: [ 60, 570 ],
		  slide: function( event, ui ) {
		   $( "#amount" ).val( "£" + ui.values[ 0 ] + " - £" + ui.values[ 1 ] );
		  }
		 });
		 $( "#amount" ).val( "£" + $( "#slider-range" ).slider( "values", 0 ) +
		  " - £" + $( "#slider-range" ).slider( "values", 1 ) );
	   /*--------------------------
		scrollUp
	   ---------------------------- */	
	   $.scrollUp({
		   scrollText: '<i class="fa fa-angle-up"></i>',
		   easingType: 'linear',
		   scrollSpeed: 900,
		   animation: 'fade'
	   }); 	   
	
   })(jQuery); 
   
   
   (function ($) {
	   "use strict";
	  
	  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			  (function(){
			  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			  s1.async=true;
			  s1.src='https://embed.tawk.to/59474840e9c6d324a47360f9/default';
			  s1.charset='UTF-8';
			  s1.setAttribute('crossorigin','*');
			  s0.parentNode.insertBefore(s1,s0);
			  })();
	  })(jQuery); 