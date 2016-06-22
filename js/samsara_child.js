// Samsara Child Theme Script

jQuery(document).ready(function($){
	
    "use strict";
    
    //init isotope
    function isotope_filter(container,selector,sizer){
       $(container).isotope({ 
          itemSelector: selector,
		  layoutMode: 'masonry',
		  masonry: {
			columnWidth: sizer
		  },
          animationEngine: 'best-available',
          filter: "*"
       });
       $(container).isotope( 'layout' );
       
       
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
        isotope_filter('.portfolio-container','.isotope', '.portfolio-item.four');
    });
    window.onresize =  isotope_filter('.portfolio-container','.isotope', '.portfolio-item.four');
    
	

});