<?php
/**
 * Blog Pagination Doc Comment
 *
 * This file displays the pagination for each page that is comprised of a list of blog entries
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

$big = 9999999;
$args = array(
	'show_all'           => false,
	'base'               => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
	'format'             => '?paged=%#%',
	'current'            => max( 1, get_query_var( 'paged' ) ),
	'prev_next'          => true,
	'prev_text'          => '<i class="fa fa-angle-left"></i>',
	'next_text'          => '<i class="fa fa-angle-right"></i>',
	'type'               => 'array',
	'add_args'           => false,
	'add_fragment'       => '',
	'before_page_number' => '',
	'after_page_number'  => '',
);
?>
<!-- navigation for multi page blog entries -->
<nav class="row pagination-container">
	<ul class="pagination">
		<?php $pag_res = paginate_links( $args );
		if ( isset( $pag_res ) ) :
			foreach ( $pag_res as $pres ) : ?>
				<li class="waves-effect">
					<?php echo wp_kses( $pres, the_steam_get_valid_theme_kses() );?>
				</li>
			<?php endforeach;
		endif;?>
	</ul>
</nav>
<!-- end navigation for multi page blog entries -->
