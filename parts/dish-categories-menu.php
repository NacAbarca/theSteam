<?php
/**
 * Dish Categories Menu Doc Comment
 *
 * This file renders a menu of dish categories
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 **/

?>
<?php
the_steam_generic_count( 'cat_index' );
$tax_terms = the_steam_get_terms();
foreach ( $tax_terms as $term ) : ?>
	<!--  dish types are listed in this menu, dish types are like categories but for custom posts - dishes -->
	<li class="menu"><a href="<?php echo esc_url( get_term_link( $term ) );?>" class="menu-topitem button-fontsize  <?php echo esc_attr( the_steam_is_active_categ( strtolower( $term->name ), 1 !== get_query_var( 'dishtype', 1 ) ? strtolower( get_query_var( 'dishtype' ) ) : strtolower( the_steam_current_category_get_current_name() ) ) );?>"><?php echo esc_html( $term->name ); ?></a></li>
	<?php  if ( ! the_steam_generic_count_is_greater( 'cat_index', count( $tax_terms ) -2 ) ) : ?>
		<li class="menu"><p class="menu-topitem">|</p></li>
	<?php endif; ?>
	<?php the_steam_generic_count( 'cat_index' );
	if ( the_steam_generic_count_is_greater( 'cat_index', 6 ) ) { break; }
endforeach;
?>
