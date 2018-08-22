<?php
/**
 * Sidebar File Doc Comment
 *
 * This file contains the blog sidebar
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

<?php
if ( is_active_sidebar( 'blog' ) ) : ?>
	<!-- sidebar container -->
	<aside class="sidebar large-4 columns show-for-large-up" id="sidebar">
		<?php dynamic_sidebar( 'blog' ); ?>
	</aside>
<?php endif; ?>
