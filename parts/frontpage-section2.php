<?php
/**
 * Frontpage Section 2 File Doc Comment
 *
 * This template part displays further info on the restaurant along with selected dish categories
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>

<!-- dish types container -->
<section id="white-section2wp" class="white-section2 ts-clearfix <?php if ( 'yes' !== the_steam_get_option( 'option_enable_dish_types' ) ) { echo esc_attr( 'hide-for-small-up' ); } ?>">
	<a id="menu-section"></a>
	<div class="row row-frip row-align features ts-clearfix dishtype-animation-supported">
		<?php
		$tax_terms = the_steam_get_terms();
		$term_index = 0;
		foreach ( $tax_terms as $term ) :
			$t_id = $term->term_id;
			$t_desc = $term->description;
			$term_meta = get_option( 'taxonomy_term_' . $t_id );
			?>
			<!-- dish type container -->
			<div class="small-6 medium-6 large-3 xlarge-3 columns menu-frip-div" data-dish="<?php echo esc_html( $term->slug ); ?>">
				<?php $term_index++; ?>
				<div class="frip-vertical-line-first show-for-large-up"></div>
				<div class="fript-container clickable frip-animation-supported">
					<!-- dish type featured image or icon -->
					<img <?php if ('' !== $term_meta['taxonomy_id']) : ?> src="<?php echo esc_url( $term_meta['taxonomy_id'] ); ?>"
					<?php else: echo 'style="visibility: hidden" '; endif; ?> class="menu-image">
					<div class="menu-pull-up">
						<!-- dish type name -->
						<h3 class="dishtype-title"><?php echo esc_html( the_steam_get_elipsis( $term->name, 16 /* chars */ ) ); ?></h3>
						<!-- dish type description -->
						<p class="show-for-medium-up dishtype-description"><?php echo wp_kses( the_steam_get_elipsis( $term->description , 150 /* chars */ ), the_steam_get_valid_theme_kses() ); ?></p>
					</div>
				</div>
				<!-- separation line -->
				<?php if ( count( $tax_terms ) >= $term_index ) : ?>
					<div class="frip-vertical-line-second frip-animation-supported <?php if ( count( $tax_terms ) > $term_index ) { echo esc_attr( 'frip-color' ); } ?> show-for-large-up"></div>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
	</div>
</section>
