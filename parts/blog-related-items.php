<?php
/**
 * Blog Related Items File Doc Comment
 *
 * This template part renders a list of three suggested blog entries for the current post
 *
 * @category File
 * @package  thesteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     http://www.webdotinc.net/thesteam
 **/

?>
<?php $suggested = new TheSteam_Suggested_Items(); ?>
<div class="row medium-up-2 large-up-3 row-setup">
	<div class="selector">
		<!-- related related post link -->
		<a class="column first-column items-align" href="<?php echo esc_url( $suggested->get_prev_item( 'url' ) ); ?>">
			<div class="triangle-container" id="triangle-container-left">
				<div class="triangle-left"></div>
				<div class="triangle-left-2"></div>
				<i class="triangle-icon-left"><i></i></i>
			</div>
			<div class="previous-post">
				<p class="previous-button">
					<?php esc_html_e( 'Previous', 'thesteam' ); ?> <span class="the-steam-show-for-medium-up previous-detail"><?php echo esc_html( ucfirst( get_post_type() ) ); ?></span>
				</p>
			</div>
		</a>
		<a class="column second-column the-steam-show-for-large-up items-align-under"  href="<?php echo esc_url( $suggested->get_mid_item( 'url' ) ); ?>">
			<div class="similar-recipes">
				<!-- related post link -->
				<p class="similar" ><?php esc_html_e( 'Suggested', 'thesteam' ); ?>
				</p>
				<div class="above-selector">
					<div id="triangle-down-back"></div>
					<div id="triangle-down"></div>
				</div>
			</div>
		</a>
		<a class="column first-column items-align" href="<?php echo esc_url( $suggested->get_next_item( 'url' ) ); ?>">
			<div class="next-post">
				<!-- next related post link -->
				<p class="next-button">
					<?php esc_html_e( 'Next', 'thesteam' ); ?> <span class="the-steam-show-for-medium-up previous-detail"> <?php echo esc_html( ucfirst( get_post_type() ) ); ?></span>
				</p>
			</div>
			<div class="triangle-container">
				<div class="triangle-right"></div>
				<div class="triangle-right-2"></div>
				<i class="triangle-icon-right"><i></i></i>
			</div>
		</a>
	</div>
</div>
<div class="row trio-selector">
	<!-- related post thumbnail -->
	<figure class="column photo-align-selector">
		<a href="<?php echo esc_url( $suggested->get_prev_item( 'url' ) ); ?>">
			<?php if ( null !== $suggested->get_prev_item( 'thumb_url' ) && 5 < strlen( $suggested->get_prev_item( 'thumb_url' ) ) ) : ?>
				<div class="sugested-posts first-image-selector">
					<img alt="Previous post" class="sugested-posts first-image-selector"
						 src="<?php echo esc_url( $suggested->get_prev_item( 'thumb_url' ) ); ?>"/>
				</div>
			<?php endif; ?>
			<p class="under-selector">
					<?php echo esc_html( the_steam_get_elipsis( $suggested->get_prev_item( 'title' ), 25 ) ); ?>
			</p>
		</a>
	</figure>
	<!-- related post thumbnail -->
	<figure class="column the-steam-show-for-large-up photo-align-selector">
		<a href="<?php echo esc_url( $suggested->get_mid_item( 'url' ) ); ?>">
			<?php if ( null !== $suggested->get_mid_item( 'thumb_url' ) && 5 < strlen( $suggested->get_mid_item( 'thumb_url' ) ) ) : ?>
				<div class="sugested-posts first-image-selector">
					<img alt="Suggested post" class="sugested-posts second-image-selector"
						 src="<?php echo esc_url( $suggested->get_mid_item( 'thumb_url' ) ); ?>"/>
				</div>
			<?php endif; ?>
			<p class="under-selector">
					<?php echo esc_html( the_steam_get_elipsis( $suggested->get_mid_item( 'title' ), 25 ) ); ?>
			</p>
		</a>
	</figure>
	<!-- related post thumbnail -->
	<figure class="column photo-align-selector">
		<a href="<?php echo esc_url( $suggested->get_next_item( 'url' ) ); ?>">
			<?php if ( null !== $suggested->get_next_item( 'thumb_url' )  && 5 < strlen( $suggested->get_next_item( 'thumb_url' ) ) ) : ?>
				<div class="sugested-posts first-image-selector">
					<img alt="Next post" class="sugested-posts third-image-selector"
						 src="<?php echo esc_url( $suggested->get_next_item( 'thumb_url' ) ); ?>"/>
				</div>
			<?php endif; ?>
			<p class="under-selector">
					<?php echo esc_html( the_steam_get_elipsis( $suggested->get_next_item( 'title' ), 25 ) ); ?>
			</p>
		</a>
	</figure>
</div>
