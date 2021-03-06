         <?php if (have_posts()):?>    
              <?php 
			  $portfolio_columns=trim(strip_tags(get_post_meta($post->ID, "portfolio_columns_value", true))); 
			  if($portfolio_columns==2){
			    $grid='eight columns ';
			  }elseif($portfolio_columns==3){
			    $grid='one-third column ';
			  }else{
			    $grid=' columns';
			  }
			  
			  $i = 1;

			  while (have_posts()) : the_post(); 
			  			
				 
			  
                 $portfolio_type=trim(strip_tags(get_post_meta($post->ID, "portfolio_type_value", true)));
				 $portfolio_link=trim(strip_tags(get_post_meta($post->ID, "portfolio_link_value", true)));
				 if($portfolio_link<>''){
			       $link=$portfolio_link;
				   $target=' target="_blank"';
				 }else{
				   $link=get_permalink();
				   $target=' target="_self"';
				 }
				 
				 $terms = get_the_terms( $post->ID, 'portfolios');
	             $slug=array();
				 if(has_post_thumbnail($post->ID)){
				  

				  
					$image_id = get_post_thumbnail_id(get_the_ID());
					
					$imageObj = wp_get_attachment_image_src($image_id, 'full');
					

					$imageWidth = $imageObj[1];
					$imageHeight = $imageObj[2];
					$imageAspectRatio = $imageWidth / $imageHeight; 
					
					$imageCols = ($imageAspectRatio > 2) ? 'eight' : 'four';

					
					$thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_medium', true);
				 if ( $terms && ! is_wp_error( $terms ) ){
					foreach ( $terms as $term ){
						$slug[] = $term->slug;
					}
					$on_slug = join( " ", $slug); ?>

					<div class="portfolio-item isotope hover <?php echo $imageCols; echo $grid; ?> <?php //echo blazyLoaderClasses($i); ?> <?php echo $on_slug;?>">
					  <?php if($blazy_load == 'true'): ?>
						  <a href="<?php echo $link;?>" class="thumbnail" title="<?php the_title();?>">
							  <img class="b-lazy" data-src="<?php echo $thumbnail_url[0];?>" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== /></a>
							  <h4>
								  <a href="<?php echo $link;?>"><?php the_title();?></a>
							  </h4>
						  </a>
					  <?php else: ?>
						  <a href="<?php echo $link;?>" class="thumbnail" title="<?php the_title();?>">
							  <img src="<?php echo $thumbnail_url[0];?>" /></a>
							  <h4>
								  <a href="<?php echo $link;?>"><?php the_title();?></a>
							  </h4>
						  </a>
					  <?php endif; ?>
					</div>				
            
			      <?php }
                 } 
				 $i++;
			     endwhile;
			     ?>
                
         <?php else:?> 
           <article class="post">
            <div class="entry">
                   <?php _e( 'No Portfolios Found In This Category', 'Samsara' ); ?>
             </div>
             <div class="clear"></div>
           </article>
         <?php endif;?>