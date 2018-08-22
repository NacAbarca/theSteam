<?php
/**
 * Single File Doc Comment
 *
 * This file displays the sidebar on the page with the list of dishes
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 * Text Domain: thesteam
 **/

?>
<?php if ( is_active_sidebar( 'dishes' ) ) : ?>
	<!-- sidebar for custom posts - dishes -->
	<aside class="sidebar large-4 columns show-for-large-up">
		<?php dynamic_sidebar( 'dishes' ); ?>
	</aside>
<?php endif; ?>
