<?php
/**
 * Search Form File Doc Comment
 *
 * This file displays the search form used inside sidebars
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
<!-- search form - used along widgets -->
<form role="search" method="get" id="searchform" name="tsform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-container"><label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'thesteam' ); ?></label>
		<span class="search-icon" aria-hidden="true" onclick="tsform.submit()"><i class="fa fa-search clickable" aria-hidden="true"></i></span>
		<input type="text" value="" placeholder="<?php esc_html_e( 'search ...', 'thesteam' ); ?>" name="s" id="s"/>
	</div>
</form>
