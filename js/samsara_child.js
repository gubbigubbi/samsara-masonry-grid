// Samsara Child Theme Script

jQuery(document).ready(function($){
	
    "use strict";
    
    //init isotope
    function isotope_filter(container,selector){
       $(container).isotope({ 
          itemSelector: selector,
          animationEngine: 'best-available',
          filter: "*"
       });
       $(container).isotope( 'reLayout' );
       
       
       $('.filter a').click(function(){
              var selector = $(this).attr('data-filter');
              $(container).isotope({ 
                filter: selector
              });
              $(this).parent().attr('class','current');
              $(this).parent().siblings().removeAttr('class');
              return false;
       });
    }
    $(window).load(function(){
        isotope_filter('.portfolio-container','.portfolio-item');
    });
    window.onresize = function() { //redo the isotope on resize
        isotope_filter('.portfolio-container','.portfolio-item');
    }

});