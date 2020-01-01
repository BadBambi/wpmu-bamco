/*
  Bstone Js
*/

// Menu Toggle
var bstone_menu_toggle  	 = document.querySelector('.main-header-menu-toggle');
var bstone_body  			 = document.querySelector('body');

if( null !== bstone_menu_toggle ) {
  bstone_menu_toggle.addEventListener( 'click', function ( event ) {
    event.preventDefault();
    
    bstone_menu_toggle.classList.toggle("toggled");
    bstone_body.classList.toggle("menu-toggled");
  });
}

// Masonry Blog Posts
var masonary_required  = document.querySelector('.bst-masonry-posts');
var masonary_container = document.querySelector('.bst-posts-cnt');
var masonary_element   = document.querySelector('article');

if( null !== masonary_required && null !== masonary_container && null !== masonary_element ) {
	var elem = document.querySelector('.bst-masonry-posts .bst-posts-cnt');
	var msnry = new Masonry( elem, {
	    itemSelector: 'article',
		columnWidth: '.masonry-grid-sizer',
		isAnimated: true
  });

  window.onload = function() {
    msnry.reloadItems();
    msnry.layout();
  };
}

// Scroll to Top
var sctop_element   = document.querySelector('#bstone-scroll-top');

if( null !== sctop_element ) {
  document.getElementById("bstone-scroll-top").addEventListener("click", function(event) {

    event.preventDefault();

    var scrollDuration = 500;

    var scrollStep = -window.scrollY / (scrollDuration / 15),
      scrollInterval = setInterval(function(){
      if ( window.scrollY != 0 ) {
        window.scrollBy( 0, scrollStep );
      }
      else clearInterval(scrollInterval);
    },15);
  });

  window.onscroll = function() {
    toggle_bstone_sctop();
  };

  function toggle_bstone_sctop() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      document.getElementById("bstone-scroll-top").className = "sctop-enabled";
    } else {
      document.getElementById("bstone-scroll-top").className = "";
    }
  }
}

// Owl Carousel
jQuery.noConflict();
(function( $ ) {
  $(function() {
    
    if ( $( ".bp-slider.owl-carousel" ).length ) {

      var bstPostSlider = $( ".bp-slider.owl-carousel" );

      var bstPSliderMargin      = 0;
      var bstPSliderDnum        = 3;
      var bstPSliderTnum        = 2;
      var bstPSliderMnum        = 1;
      var bstPSliderMbreakpoint = 480;
      var bstPSliderTbreakpoint = 768;
      
      if( typeof bstone_header_break_points !== 'undefined' ) {
        bstPSliderMbreakpoint = parseInt( bstone_header_break_points['break_point_mobile'] );
        bstPSliderTbreakpoint = parseInt( bstone_header_break_points['break_point_tablet'] );
      }

      if( bstPostSlider.attr( 'data-margin' ) ) {
        bstPSliderMargin = parseInt( bstPostSlider.attr( 'data-margin' ) );
      }

      if( bstPostSlider.attr( 'data-slids-d' ) ) {
        bstPSliderDnum = parseInt( bstPostSlider.attr( 'data-slids-d' ) );
      }

      if( bstPostSlider.attr( 'data-slids-t' ) ) {
        bstPSliderTnum = parseInt( bstPostSlider.attr( 'data-slids-t' ) );
      }

      if( bstPostSlider.attr( 'data-slids-m' ) ) {
        bstPSliderMnum = parseInt( bstPostSlider.attr( 'data-slids-m' ) );
      }

      var bstSliderOptions = {
        loop:true,
        margin:bstPSliderMargin,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true
      };

      if( bstPostSlider.attr( 'data-slids-d' ) && bstPostSlider.attr( 'data-slids-t' ) && bstPostSlider.attr( 'data-slids-m' ) ) {
        bstSliderOptions['responsive'] = {};
        bstSliderOptions['responsive'][0] = {};
        bstSliderOptions['responsive'][0]['items'] = bstPSliderMnum;
        bstSliderOptions['responsive'][bstPSliderMbreakpoint] = {};
        bstSliderOptions['responsive'][bstPSliderMbreakpoint]['items'] = bstPSliderTnum;
        bstSliderOptions['responsive'][bstPSliderTbreakpoint] = {};
        bstSliderOptions['responsive'][bstPSliderTbreakpoint]['items'] = bstPSliderDnum;
      }     

      bstPostSlider.owlCarousel( bstSliderOptions );
    }

  });
})(jQuery);