<?php 
global $SSR_VAN;
get_header();

//.................................
//When it's a static page
//.................................
query_posts('post_type=page&page_id='.get_option('woocommerce_shop_page_id'));
while ( have_posts() ) : the_post(); 
//Output the custom CSS for the separate page
echo van_custom_page($post->ID);

$hide_title=get_post_meta($post->ID, "hide_title_value", true);
$page_title=get_post_meta($post->ID, "page_title_value", true);
$page_tagline=get_post_meta($post->ID, "page_desc_value", true);
$page_header_img=get_post_meta($post->ID, "page_header_img_value", true);
if($page_header_img<>''):
?>
 <div class="fullscreen_stage" style="background-image:url(<?php echo $page_header_img; ?>);">
          <?php if($hide_title=="No" || $hide_title==""):?>
          <div class="post_title">
            <h2><?php if($page_title<>''){echo $page_title;}else{the_title();}?></h2>
            <?php if($page_tagline<>''):?>
            <p><?php echo do_shortcode($page_tagline);?></p>
            <?php endif;?>
          </div>
          <?php endif;?>
 </div>
<?php
endif;
endwhile;
wp_reset_query();

//.................................
//When it's a archive page
//.................................
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$cat_id = $term->term_id;
$cat_data = get_option("category_$cat_id");
$cat_header=$cat_data['header_image'];
if($cat_header<>''):
?>
<div class="fullscreen_stage">
  <div class="post_title">
     <h2 class="page_title"><?php echo $term->name;?></h2>
     <?php if($term->description<>''):?>
      <p><?php echo $term->description;?></p>
     <?php endif;?>
  </div>
  <img src="<?php echo $cat_header;?>" alt="<?php echo $term->name;?>" class="post_cover" />
</div>
<?php endif;?>

  <div id="container" class="container">
     <div id="main" class="columns<?php if(isset($SSR_VAN['remove_sidebar_archive']) && $SSR_VAN['remove_sidebar_archive']==1){ echo' twelve';}else{echo' sixteen';}?>">
           
        <?php if($page_header_img==''):?>
        
             <?php 
			 //.................................
			 //When it's a archive page
			 //.................................
			 if(is_tax('product_cat')):
			   if($cat_header==''):
			 ?>
              <div class="van_headline <?php echo $SSR_VAN['heading_pattern'];?>">
			  <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?>
                  <h2><?php echo $term->name;?></h2>
                  <?php if($term->description<>''):?>
                  <p><?php echo $term->description;?></p>
                  <?php endif;?>
              </div>
              <?php 
			    endif;
			  else:?>
              <?php 
			    //.................................
				//When it's a static page
				//.................................
			   query_posts('post_type=page&page_id='.get_option('woocommerce_shop_page_id'));
			   while ( have_posts() ) : the_post(); 
			    if($hide_title=="No" || $hide_title==""):
			  ?>
                <div class="van_headline <?php echo $SSR_VAN['heading_pattern'];?>">
			      <h2><?php the_title();?></h2>
                  <?php if($page_tagline<>''):?>
                  <p><?php echo do_shortcode($page_tagline);?></p>
                  <?php elseif(get_the_excerpt()<>''):?>
                  <p><?php echo van_truncate(strip_tags(get_the_excerpt()),150)?></p>
                  <?php endif;?>
                 </div>
               <?php
			    endif;
			   endwhile;
			   wp_reset_query();
			   ?>
             <?php endif;?>
          
          <?php endif;?>
           
         <?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				//do_action( 'woocommerce_after_shop_loop' );
			?>

		 <div class="pagination">
			  <?php next_posts_link( "Load More Portfolio Item's" ); ?>
		 </div>

     </div>
	 

     
     <?php if(isset($SSR_VAN['remove_sidebar_archive']) && $SSR_VAN['remove_sidebar_archive']==1){get_sidebar('shop');}?>
     
  </div><!-- container -->
<?php get_footer();?>