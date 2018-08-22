<?php
/**
 * Frontpage Gallery
 *
 * This template part displays a gallery of images
 *
 * @category File
 * @package  TheSteam
 * @author   WDI
 * @license  GPLv2 or later
 * @license URI http://www.gnu.org/licenses/gpl-2.0.html
 * @link     www.webdotinc.com
 **/

?>
<?php
$img_arr = array();
for ( $index = 0; $index <= 11; $index++ ) :
	 $img_url = the_steam_get_theme_mod( 'the_steam_gallery_image' . $index, '#' );
	 if ( '#' !== $img_url ) :
		 array_push($img_arr, $img_url);
	 endif;
endfor;
?>
<section class="sixthImage <?php if ( 'yes' === the_steam_get_option( 'option_disable_gallery' ) ) { echo esc_attr( 'hide-for-small-up' ); } ?>">
	<div class="steam-gallery-container" <?php if ( 0 >= sizeof($img_arr)) { echo 'style="display: none;" ';}; ?>>
		<ul class="steam-gallery-list" id="gallery-list">
			<?php for ( $index = 0; $index <= 11; $index++ ) : ?>
				<?php if ( array_key_exists( $index, $img_arr ) && isset( $img_arr[$index] ) ) : ?>
					<div class="steam-individual-thumbnail steam-thumbnail-media gallery<?php echo $index; ?>">
						<a class="steam-gallery-image-anchor no-load" href="<?php echo esc_url( $img_arr[$index] ); ?>"></a>
						<div class="steam-thumb-pad">
							<div class="steam-ab-thmb"></div>
							<div class="gallery-image-container">
								<div class="steam-padding-thumb steam-thumb-op steam-thumb-bg"></div>
								<div class="steam-gallery-img">
									<img id="gallery-thumb<?php echo esc_attr( $index );?>" class="steam-img-thmb" src="<?php echo esc_url( $img_arr[$index] );?>"/>
									<span class="steam-img-meta">
										<span class="steam-img-magnify">
											<i class="fa fa-3x fa-search" aria-hidden="true"></i>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>
			<?php endfor; ?>
		</ul>
	</div>
</section>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>
