jQuery(document).ready(function($) {
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
        /* if (currentScroll <= 0) {
          $('#main-header').removeClass();
        } */
      }
      // if user is at the bottom of document show menu
      /* if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        $('#main-header').removeClass('invisible');
      } */
      // replace previous scroll position with new one
      previousScroll = currentScroll;
    }
  })
});