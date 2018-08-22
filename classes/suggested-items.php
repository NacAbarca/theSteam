<?php
/**
 * Suggested Items File Doc Comment
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
 * TheSteam_Suggested_Items Class Doc Comment
 *
 * @category Class
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @link     www.webdotinc.com
 * Text Domain: thesteam
 **/

if ( ! class_exists( 'TheSteam_Suggested_Items' ) ) {
	/**
	 * Class TheSteam_Suggested_Items provides suggested items for the current post
	 */
	class TheSteam_Suggested_Items
	{
		/**
		 * Instance was created to retrieve only random items or not
		 *
		 * @var bool True if only random items are retrieved
		 */
		protected $m_full_random;
		/**
		 * Left item is an array of elements like post title, post url, etc
		 *
		 * @var array Left item
		 */
		protected $left_item;
		/**
		 * Right item is an array of elements like post title, post url, etc
		 *
		 * @var array right item
		 */
		protected $right_item;
		/**
		 * Middle item is an array of elements like post title, post url, etc
		 *
		 * @var array midItem
		 */
		protected $mid_item;

		/**
		 * Retrives a random post according the current browsed post type
		 *
		 * @return null|WP_Post A random post from the database
		 */
		protected function get_random_post() {

			/* can't use vip for rand as phcps suggests */
			if ( 'dish' === get_post_type() ) {
				$query_args = array(
					'orderby'        => 'rand',
					'posts_per_page' => '1',
					'post_type'      => 'dish',
					'post_status'    => 'publish',
				);
			} else {
				$query_args = array(
					'orderby'        => 'rand',
					'posts_per_page' => '1',
					'post__not_in'   => get_option( 'sticky_posts' ),
					'post_status'    => 'publish',
				);
			}

			$related_items_query = new WP_Query( $query_args );

			wp_reset_postdata();

			if ( $related_items_query->have_posts() ) {
				return $related_items_query->post;
			}

			return null;
		}

		/**
		 * Handles initialisation of members
		 *
		 * If a post doesn't have featured image, then no image will be returned.
		 */
		protected function init() {

			$next_post = $this->m_full_random ? $this->get_random_post() : get_next_post();
			/* mid item is always random */
			$random_post = $this->get_random_post();
			$prev_post = $this->m_full_random ? $this->get_random_post() : get_previous_post();

			$safety_rand_post = null;

			if ( null === $next_post || null === $prev_post || '' === $next_post || '' === $prev_post ) {
				$safety_rand_post = $this->get_random_post();
			}

			$this->right_item = array(
				'url' => (null !== $next_post && '' !== $next_post) ? get_permalink( $next_post->ID ) : get_permalink( $safety_rand_post->ID ),
				'title' => (null !== $next_post && '' !== $next_post) ? get_the_title( $next_post->ID ) : get_the_title( $safety_rand_post->ID ),
				'thumb_url' => (null !== $next_post && '' !== $next_post) ? ( false !== wp_get_attachment_url( get_post_thumbnail_id( $next_post->ID ) ) ? wp_get_attachment_url( get_post_thumbnail_id( $next_post->ID ) ) : null ) : wp_get_attachment_url( get_post_thumbnail_id( $safety_rand_post->ID ) ),
			);

			$this->mid_item = array(
				'url' => (null !== $random_post && '' !== $random_post) ? get_permalink( $random_post->ID ) : null,
				'title' => (null !== $random_post && '' !== $random_post) ? get_the_title( $random_post->ID ) : esc_html__( 'Untitled', 'thesteam' ),
				'thumb_url' => (null !== $random_post && '' !== $random_post && false !== wp_get_attachment_url( get_post_thumbnail_id( $random_post->ID ) )) ? wp_get_attachment_url( get_post_thumbnail_id( $random_post->ID ) ) : null,
			);

			$this->left_item = array(
				'url' => (null !== $prev_post && '' !== $prev_post) ? get_permalink( $prev_post->ID ) : get_permalink( $safety_rand_post->ID ),
				'title' => (null !== $prev_post && '' !== $prev_post) ? get_the_title( $prev_post->ID ) : get_the_title( $safety_rand_post->ID ),
				'thumb_url' => (null !== $prev_post && '' !== $prev_post) ? ( false !== wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) ) ? wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) ) : null ) : wp_get_attachment_url( get_post_thumbnail_id( $safety_rand_post->ID ) ),
			);
		}

		/**
		 * Object constructor
		 *
		 * @param bool|false $full_random If fullRandom is yes, then only random elements are returned.
		 */
		public function __construct( $full_random = false ) {

			$this->m_full_random = $full_random;

			$this->init();
		}

		/**
		 * Retrieves previous item, more specifically details regarding the previous post
		 *
		 * @param string $key Array key, can be title, url or thumb url.
		 *
		 * @return string Result for the key provided
		 */
		public function get_prev_item( $key ) {

			return array_key_exists( $key, $this->left_item ) ? $this->left_item[ $key ] : null;
		}

		/**
		 * Retrieves middle suggested item, which si always random
		 *
		 * @param string $key Array key, can be title, url or thumb url.
		 *
		 * @return string Result for the key provided
		 */
		public function get_mid_item( $key ) {

			return array_key_exists( $key, $this->mid_item ) ? $this->mid_item[ $key ] : null;
		}

		/**
		 * Retrieves next item, more specifically details like tile or permalink for the next post
		 *
		 * @param string $key Array key, can be title, url or thumb url.
		 *
		 * @return string Result for the key provided
		 */
		public function get_next_item( $key ) {

			return array_key_exists( $key, $this->right_item ) ? $this->right_item[ $key ] : null;
		}
	}
}
?>
