<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

$image_id = get_post_thumbnail_id(get_the_ID());
				
$imageObj = wp_get_attachment_image_src($image_id, 'full');

$imageWidth = $imageObj[1];
$imageHeight = $imageObj[2];
$imageAspectRatio = $imageWidth / $imageHeight; 

$thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_medium', true);

// Extra post classes
$classes = array();
$classes[] = 'portfolio-item isotope hover columns';
$classes[] = ($imageAspectRatio > 1.5) ? 'eight' : 'four';
?>
<div <?php post_class( $classes ); ?>>

	<a href="<?php the_permalink(); ?>" class="thumbnail" title="<?php the_title();?>">
		<img src="<?php echo $thumbnail_url[0];?>" alt="<?php the_title();?>" />
	</a>

	<a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		<div class="product-description">
			<h3><?php the_title(); ?></h3>
	
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	

</div>