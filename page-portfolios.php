<?php
/*Template Name: Portfolios Archive*/
global $SSR_VAN;
get_header();
get_template_part('content','pageheader');
?>

  <div id="container" class="container">
         <?php while(have_posts() ) : the_post(); 
		 $hide_title=get_post_meta($post->ID, "hide_title_value", true);
		 $page_title=get_post_meta($post->ID, "page_title_value", true);
		 $page_tagline=get_post_meta($post->ID, "page_desc_value", true);
		 $page_header_img=get_post_meta($post->ID, "page_header_img_value", true);
		 ?>
         
         <?php if($page_header_img==''):?>
          <?php if($hide_title=="No" || $hide_title==""):?>
           <div class="van_headline <?php echo $SSR_VAN['heading_pattern'];?>">
                <h2><?php if($page_title<>''){echo $page_title;}else{the_title();}?></h2>
                <?php if($page_tagline<>''):?>
                  <p><?php echo do_shortcode($page_tagline);?></p>
                <?php endif;?>
          </div>
          <?php endif;?>
        <?php endif;?>
        
        <?php endwhile;?>
          
           <div class="portfolio-posts section container">
             <header> <?php if ( function_exists( 'van_portfolios_filter' ) ) {van_portfolios_filter('portfolios','','',true);}?></header>

             <div id="portfolio-masonry" class="portfolio-container">
             <?php
			 $limit = get_option('posts_per_page');
			 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			 query_posts('post_type=portfolio&posts_per_page='.$limit.'&paged='.$paged);
			 get_template_part('content','portfolios');
			 ?> 
             </div>
             <?php echo van_pagenavi();?>
           </div><!--Portfolios-->
   </div><!-- container -->
<?php get_footer();?>