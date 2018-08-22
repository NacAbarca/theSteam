<?php
/**
 * TheSteam Mobile Menu File Doc Comment
 *
 * @category Menus
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

/**
 * TheSteam_Frontpage_Mobile_Nav_Menu Class Doc Comment
 *
 * @category Class
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license  URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/
class TheSteam_Frontpage_Mobile_Nav_Menu extends TheSteam_Bootstrap_Nav_Menu {
	/**
	 * Overrides parent method to add list items
	 *
	 * @param string $output Output argument from parent implementation.
	 * @param object $object Object argument from parent implementation.
	 * @param int    $depth Depth argument from parent implementation.
	 * @param array  $args Args argument from parent implementation.
	 * @param int    $current_object_id Current object id from parent implementation.
	 */
	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		if ( 0 !== $depth ) {
			return;
		}

		if ( $this->finished() ) {
			return;
		}

		$output .= '<li id="fpm-'.$this->m_index.'" class="over-menu-li"><a class="no-load" href="' . esc_url( $object->url ) . '">' . strtoupper( esc_html( $object->title ) );

		$this->m_index++;
	}

	/**
	 * Overrides parent method and closes opened HTML anchors and list items
	 *
	 * @param string $output Output argument from parent implementation.
	 * @param object $object Object argument from parent implementation.
	 * @param int    $depth Menu depth argument from parent implementation.
	 * @param array  $args Args argument from parent implementation.
	 */
	function end_el( &$output, $object, $depth = 0, $args = array() ) {
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
	}
}
?>
