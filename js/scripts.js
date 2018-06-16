jQuery(document).ready(function($) {

   /**
   * Extension function to check if an attribute of element has changed (invisible class for #main-header in particular)
   */
  (function($) {
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

    $.fn.attrchange = function(callback) {
        if (MutationObserver) {
            var options = {
                subtree: false,
                attributes: true
            };

            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(e) {
                    callback.call(e.target, e.attributeName);
                });
            });

            return this.each(function() {
                observer.observe(this, options);
            });

        }
    }
  })(jQuery);

  /**
   * Menu Hide
   */
  var previousScroll = 0, // previous scroll position
    menuOffset = 60, // height of menu (once scroll passed it, menu is hidden)
    detachPoint = 650, // point of detach (after scroll passed it, menu is fixed)
    hideShowOffset = 6; // scrolling value after which triggers hide/show menu
  /**
   * on scroll hide/show menu
   */
  $(window).scroll(function() {
    if (!$('#main-header').hasClass('expanded')) {
      var currentScroll = $(this).scrollTop(), // gets current scroll position
        scrollDifference = Math.abs(currentScroll - previousScroll); // calculates how fast user is scrolling
      // if scrolled past menu
      if (currentScroll > menuOffset) {
        // if scrolled past detach point add class to fix menu
        if (currentScroll > detachPoint) {
          if (!$('#main-header').hasClass('detached')) $('#main-header').addClass('detached');
          $('#main-header').removeClass('at-top');
        }
        // if scrolling faster than hideShowOffset hide/show menu
        if (scrollDifference >= hideShowOffset) {
          if (currentScroll > previousScroll) {
            // scrolling down; hide menu
            if (!$('#main-header').hasClass('invisible')) $('#main-header').addClass('invisible');
          } else {
            // scrolling up; show menu
            if ($('#main-header').hasClass('invisible')) $('#main-header').removeClass('invisible');
          }
        }
      } else {
        // only remove “detached” class if user is at the top of document (menu jump fix)
        if (currentScroll <= 0) {
          // $('#main-header').removeClass();
          $('#main-header').addClass('at-top');
        }
      }
      // if user is at the bottom of document show menu
      /* if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        $('#main-header').removeClass('invisible');
      } */
      // replace previous scroll position with new one
      previousScroll = currentScroll;
    }
  })


  	/**
	 * Content Marketing : continue reading button
	 */
	$('.slide-down').hide();
	$( '.slide-down-trigger' ).click(function() {
		$('.slide-down.collapse').addClass('in');
		$('.slide-down').slideDown();
  });
  

  	/***
	 * Forms specific animation trigger
	 */
  // on focus
	$(".input-animation-trigger").focus(function() {
    $(this).parent().siblings('label').addClass('has-value');
  })
  // blur input fields on unfocus + if has no value
  .blur(function() {
    var text_val = $(this).val();
    if(text_val === "") {
      $(this).parent().siblings('label').removeClass('has-value');
    }
  });
  
  /**
   * Open nav submenus with a click
   */
  $( '#top-menu > li' ).click(function() {
      $("ul", this).toggleClass('show-grid');
    });

    $(window).click(function() {
      $( '#top-menu > li > ul' ).removeClass('show-grid');
    });

    $('#top-menu').click(function(event){
      event.stopPropagation();
  });


  /**
   * Collapsible submenus in mobile
   */   
  function setup_collapsible_submenus() {
      var $menu = $('#mobile_menu'),
          top_level_link = '.menu-item-has-children.can-clicked > a';
      $menu.find('a').each(function() {
          $(this).off('click');
           
          if ( $(this).is(top_level_link) ) {
              $(this).attr('href', '#');
              $(this).next('.sub-menu').addClass('hide');
          }
           
          if ( ! $(this).siblings('.sub-menu').length ) {
              $(this).on('click', function(event) {
                  $(this).parents('.mobile_nav').trigger('click');
              });
          } else {
              $(this).on('click', function(event) {
                  event.preventDefault();
                  $(this).next('.sub-menu').toggleClass('visible');
              });
          }
      });
  }
   
  $(window).load(function() {
      setTimeout(function() {
          setup_collapsible_submenus();
      }, 300);
  });


  /**
   * Check if the page is a case styudy and create the submenu
   * with the inpage links from the #IDs
   */
  if ( $('body').hasClass('single-project')) {

    var IDs = $(".entry-content .project-anchor-section[id]") 
      .map(function() { return this.id; })
      .get(); 
    
    $listSelector = $(".navbar-right")
      $.each(IDs, function(i, obj) {
        $listSelector.append("<li class=visible-lg menuEl menuEl-"+obj+"><a href=#"+obj+">"+obj.replace('-', ' ')+"</a></li>")
    });

    // control subnav's top property so it doesn't get
    // hidden by main-header
    $('#main-header').attrchange(function(attrName) {
      if(attrName=='class') {

        if ( $('#main-header').hasClass('invisible') ) {
          $('.subnav').animate({top: '0'}, 250);
          // $('.subnav').css('top', '0px');
        } else {
          $('.subnav').animate({top: '80px'}, 250);
          // $('.subnav').css('top', '80px');
        }

      }
    });

  }

});