<?php
/**
 * Blog Random Items Doc Comment
 *
 * This template part displays a list of random posts below the main post content
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @License URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<!-- three posts are suggested in this section -->
<div class="row medium-up-2 large-up-3 row-setup">
	<div class="selector">
		<div class="column first-column items-align">
			<div class="triangle-container-random">
				<div id="triangle-left"></div>
				<div id="triangle-left-front"></div>
				<div class="square"></div>
			</div>
			<?php $suggested = new TheSteam_Suggested_Items( true ); ?>
			<!-- previous post link -->
			<div class="previous-post">
				<?php

				/*
				 * Using a function and doing the escaping inside it is also
				 * suggested by Wordpress codex in this case because it is
				 * way too much duplicate code to justify, just to call
				 * esc_url() at function call time.
				 * Please see https://codex.wordpress.org/Next_and_Previous_Links#The_Next_and_Previous_Pages
				 */
				?>
				<?php the_steam_show_previous_next_page( true /* Previous. */ ); ?>
			</div>
		</div>
		<div class="column second-column the-steam-show-for-large-up items-align-under">
			<div class="similar-recipes">
				<!-- similar post link -->
				<p class="similar">
					<a class="similar" href="<?php echo esc_url( $suggested->get_mid_item( 'url' ) ); ?>"><?php esc_html_e( 'Suggested articles', 'thesteam' ); ?></a>
				</p>
				<div class="above-selector">
					<div id="triangle-down-back"></div>
					<div id="triangle-down"></div>
				</div>
			</div>
		</div>
		<div class="column first-column items-align">
			<!-- page navigation if is the case -->
			<div class="next-post">
				<?php

				/*
				 * Using a function and doing the escaping inside it is also
				 * suggested by Wordpress codex in this case because it is
				 * way too much duplicate code to justify, just to call
				 * esc_url() at function call time.
				 * Please see https://codex.wordpress.org/Next_and_Previous_Links#The_Next_and_Previous_Pages
				 */
				?>
				<?php the_steam_show_previous_next_page( false /* Next. */ ); ?>
			</div>
			<div class="triangle-container-random">
				<div class="square"></div>
				<div id="triangle-right-front"></div>
				<div id="triangle-right"></div>
			</div>
		</div>
	</div>
</div>
<!-- previous post thumbnail -->
<div class="row trio-selector">
	<div class="column photo-align-selector">
		<a href="<?php echo esc_url( $suggested->get_prev_item( 'url' ) ); ?>">
			<?php if ( null !== $suggested->get_prev_item( 'thumb_url' ) && 5 < strlen( $suggested->get_prev_item( 'thumb_url' ) ) ) : ?>
				<div class="sugested-posts first-image-selector">
					<img alt="Suggested post" class="sugested-posts first-image-selector"
						 src="<?php echo esc_url( $suggested->get_prev_item( 'thumb_url' ) ); ?>"/>
				</div>
			<?php endif; ?>
			<p class="under-selector">
				<?php echo esc_html( the_steam_get_elipsis( $suggested->get_prev_item( 'title' ), 14 ) ); ?>
			</p>
		</a>
	</div>
	<!-- random or similar post thumbnail -->
	<figure class="column the-steam-show-for-large-up photo-align-selector">
		<a href="<?php echo esc_url( $suggested->get_mid_item( 'url' ) ); ?>">
			<?php if ( null !== $suggested->get_mid_item( 'thumb_url' ) && 5 < strlen( $suggested->get_mid_item( 'thumb_url' ) ) ) : ?>
				<div class="sugested-posts first-image-selector">
					<img alt="Suggested post" class="sugested-posts second-image-selector"
						 src="<?php echo esc_url( $suggested->get_mid_item( 'thumb_url' ) ); ?>"/>
				</div>
			<?php endif; ?>
			<p class="under-selector">
				<?php echo esc_html( the_steam_get_elipsis( $suggested->get_mid_item( 'title' ), 14 ) ); ?>
			</p>
		</a>
	</figure>
	<!-- next post thumbnail -->
	<figure class="column photo-align-selector">
		<a href="<?php echo esc_url( $suggested->get_next_item( 'url' ) ); ?>">
			<?php if ( null !== $suggested->get_next_item( 'thumb_url' ) && 5 < strlen( $suggested->get_next_item( 'thumb_url' ) ) ) : ?>
				<div class="sugested-posts first-image-selector">
					<img alt="Suggested post" class="sugested-posts third-image-selector"
						 src="<?php echo esc_url( $suggested->get_next_item( 'thumb_url' ) ); ?>"/>
				</div>
			<?php endif; ?>
			<p class="under-selector">
				<?php echo esc_html( the_steam_get_elipsis( $suggested->get_next_item( 'title' ), 14 ) ); ?>
			</p>
		</a>
	</figure>
</div>
