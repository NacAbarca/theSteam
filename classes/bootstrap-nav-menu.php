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
 * TheSteam_Bootstrap_Nav_Menu Class Doc Comment
 *
 * @category Class
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/
class TheSteam_Bootstrap_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Set the properties of the element which give the ID of the current item, and its parent
	 *
	 * @var array Database fields from parent class.
	 */
	var $db_fields = array( 'parent' => 'parent_id', 'id' => 'object_id' );
	/**
	 * Current index is used to limit number of elements in the theme specific menu
	 *
	 * @var int Current index in array iteration.
	 */
	var $m_index = 0;
	/**
	 * The theme supports only 7 items in the single level menu. This is done to preserve a clean aspect
	 *
	 * @var int Max number of iterated items.
	 */
	var $max_num_items = 7;
	/**
	 * Member var is used to signal finished iterating so the end_lvl can close the div
	 *
	 * @var bool Helper var to check if iterating trough elements is finished.
	 */
	var $m_is_closed = false;
	/**
	 * Member var used to hold name
	 *
	 * @var string Menu location name.
	 */
	var $m_location_name = 'frontpage-menu';

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
	 * Getter method needed to check number of items
	 *
	 * @return int Number of items in the menu.
	 */
	function get_item_count() {
		$locations = get_nav_menu_locations();
		$menu_id = $locations[ $this->m_location_name ] ;
		$menu_object = wp_get_nav_menu_object( $menu_id );

		if ( ! empty( $menu_object ) ) {
			return $menu_object->count;
		}

		return -1;
	}

	/**
	 * Getter method needed to check whether iterating is finished
	 *
	 * @return bool True if finished iterating trough menu. Menu cannot contain more than 7 elements.
	 */
	function finished() {
		if ( $this->m_index > $this->max_num_items - 1 || $this->get_item_count() <= $this->m_index ) {
			return true;
		}

		return false;
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

		$output .= '<ul id="fp-'.$this->m_index.'" class="nav navbar-nav navbar-right ts-clearfix"><li><a class= "menu-scroll menu-topitem menu-hover" href="' . esc_url( $object->url ) . '">' . strtoupper( esc_html( $object->title ) );

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

		$output .= '</a></li></ul>';
	}
}
?>
