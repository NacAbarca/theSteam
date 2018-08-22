<?php
/**
 * TheSteam Textarea Control File Doc Comment
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
 * TheSteam_Customize_About_Textarea_Control Class Doc Comment
 *
 * @category Class
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Class TheSteam_Customize_About_Textarea_Control is used to override
	 * the default appearance of customizer textarea for specific elements
	 */
	class TheSteam_Customize_About_Textarea_Control extends WP_Customize_Control
	{
		/**
		 * Type of element that the class describes
		 *
		 * @var string $type Type of element
		 */
		public $type = 'textarea';

		/**
		 * Overrides parent method to change displaying of element
		 */
		public function render_content() {

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" maxlength="720"
		  						  class="about_textarea" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
}
?>
