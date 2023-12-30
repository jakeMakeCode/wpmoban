<?php
defined( 'ABSPATH' ) || exit;
get_header();

$ads = array(
	'inside_list' => ftt_render_shortcodes( get_theme_mod( 'ads_home_inside_list', '<a href="#!"><img src="' . get_template_directory_uri() . '/img/happy-2.png"></a>' ) ),
	'page_bottom' => ftt_render_shortcodes( get_theme_mod( 'ads_home_page_bottom', '<a href="#!"><img src="' . get_template_directory_uri() . '/img/happy-4.png"></a>' ) ),
);

add_filter(
	'theme_mod_seo_home_description',
	function( $value ) {
		return str_replace( "\n", '<br>', $value );
	}
);
?>
<div id="content">
	<div class="container">
		<?php if ( have_posts() ) :
		if ( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'homepage' ) && ! isset( $_GET['filter'] ) && ! is_paged() ) {
			dynamic_sidebar( 'Homepage' );
		} ?>
		<div class="page-header">
			<h2 class="widget-title mt-4"><?php echo ftt_get_filter_title(); ?></h2>
			<?php get_template_part( 'template-parts/content', 'filters' ); ?>
		</div>
		<div class="video-loop">
			<div class="row no-gutters">
				<div class="order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1 col-12 col-md-6 col-lg-6 col-xl-4">
				<?php if ( '' !== $ads['inside_list'] && wp_count_posts() > '1' ) : ?>
					<div class="video-block-happy">
						<div class="video-block-happy-absolute d-flex align-items-center justify-content-center">
							<?php echo $ads['inside_list']; ?>
						</div>
					</div>
				<?php endif; ?>
				</div>
				<?php
				if ( have_posts() ) :
					$video_counter = 0;
					set_query_var( 'video_loop_has_ad', ( '' !== $ads['inside_list'] ) );
					while ( have_posts() ) :
						$video_counter++;
						set_query_var( 'video_counter', $video_counter );
						the_post();
						get_template_part( 'loop-templates/loop', 'video' );
					endwhile;
				endif;
				?>
			</div>
			<?php ftt_pagination(); ?>
		</div>
	<?php endif; ?>
	</div>
	<?php if ( $ads['page_bottom'] ) : ?>
		<div class="happy-section"><?php echo $ads['page_bottom']; ?></div>

	<?php endif; ?>
	<div class="hero">
		<div class="container" tabindex="-1">
			<div class="hero-text">
				<h1><?php echo get_theme_mod( 'seo_home_title', get_bloginfo( 'description' ) ); ?></h1>
				<p><?php echo get_theme_mod( 'seo_home_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.' ); ?></p>
			</div>
		</div>
	</div>
</div>
<?php
	get_footer();
