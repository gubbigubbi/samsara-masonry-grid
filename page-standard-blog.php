<?php 
/*Template Name: Standard Blog*/
global $SSR_VAN;
get_header();
get_template_part('content','pageheader');
?>
   <div id="container" class="container">
        <div id="main" class="columns twelve">
           <?php
             $limit = get_option('posts_per_page');
			 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			 query_posts('posts_per_page='.$limit.'&paged='.$paged);
		   ?>
           <?php get_template_part('loop','default');?> 
		   
		  <div class="pagination">
			  <?php next_posts_link( "Load More Portfolio Item's" ); ?>
		  </div>
		   
         </div><!--main-->
         
          <?php get_sidebar();?>
    </div><!-- container -->
<?php get_footer();?>