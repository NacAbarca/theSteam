<?php
/**
 * Bootstrap Nav Menu File Doc Comment
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

/**
 * TheSteam_Blog_Menu Class Doc Comment
 *
 * @category Class
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/
class TheSteam_Blog_Menu extends TheSteam_Bootstrap_Nav_Menu {
	/**
	 * The theme supports only 8 items in the single level menu. This is done to preserve a clean aspect
	 *
	 * @var int Max number of iterated items.
	 */
	var $max_num_items = 7;
	/**
	 * Member var used to hold name
	 *
	 * @var string Menu location name.
	 */
	var $m_location_name = 'blog-menu';

	/**
	 * Overrides parent method, does not alter elements because the theme menu is on a single level
	 *
	 * @param string $output Output argument from parent implementation.
	 * @param int    $depth Menu depth argument from parent implementation.
	 * @param array  $args Args from parent implementation.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 !== $depth ) {
			return;
		}

		$output .= '';
	}

	/**
	 * Overrides parent method, does not alter elements because the theme menu is displayed on a single level
	 *
	 * @param string $output Output argument from parent implementation.
	 * @param int    $depth Menu depth argument from parent implementation.
	 * @param array  $args Args argument from parent implementation.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {

		/* In depth elements are not shown */
		if ( 0 !== $depth ) {
			return;
		}

		$output .= '';
	}

	/**
	 * Overrides parent method to add unordered list and list item for the bootstrap menu
	 *
	 * @param string $output Output argument from parent implementation.
	 * @param object $object Object argument from parent implementation.
	 * @param int    $depth Depth argument from parent implementation.
	 * @param array  $args Args argument from parent implementation.
	 * @param int    $current_object_id Current object id from parent implementation.
	 */
	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

		/* In depth elements are not shown */
		if ( 0 !== $depth ) {
			return;
		}

		if ( $this->finished() ) {
			return;
		}

		$output .= '<li class="menu-bloglist bloglist-menu-color"><a class= "menu-topitem bloglist-menu-color menu-button-decoration " href="' . esc_url( $object->url ) . '">' . ucfirst( esc_html( $object->title ) );

		$this->m_index++;
	}

	/**
	 * Overrides parent method and closes opened HTML elements
	 *
	 * @param string $output Output argument from parent implementation.
	 * @param object $object Object argument from parent implementation.
	 * @param int    $depth Menu depth argument from parent implementation.
	 * @param array  $args Args argument from parent implementation.
	 */
	function end_el( &$output, $object, $depth = 0, $args = array() ) {

		/* In depth elements are not shown */
		if ( 0 !== $depth ) {
			return;
		}

		if ( $this->finished() ) {
			if ( $this->m_is_closed ) {
				return;
			} else {
				$this->m_is_closed = true;
			}
		}

		$output .= '</a></li>';

		/* Add separator */
		if ( $this->get_item_count() > $this->m_index && ! $this->finished() ) {
			$output .= '<li class="menu-bloglist bloglist-menu-color"><p class="menu-topitem bloglist-menu-color">|</p></li>';
		}
	}
}
?>
