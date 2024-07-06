<?php
if ( ! defined( 'FW' ) && !function_exists( 'jevelin_framework' ) ) { die( 'Forbidden.' ); }
/*-----------------------------------------------------------------------------------*/
/* Team Member HTML
/*-----------------------------------------------------------------------------------*/
$id = '';
if( isset( $atts['id'] ) ) :
	$id = $atts['id'];
elseif( isset( $id_rand ) ) :
	$id = $id_rand;
endif;
$layout = ( isset( $atts['layout'] ) ) ? $atts['layout'] : 'style1';
$icon_style = ( isset( $atts['icon_style'] ) ) ? $atts['icon_style'] : 'overlay';
$image = ( isset( $atts['image'] ) ) ? $atts['image'] : '';
$name = ( isset( $atts['name'] ) ) ? $atts['name'] : '';
$role = ( isset( $atts['role'] ) ) ? $atts['role'] : '';
$image_lightbox = '';
$icons = array();
$icons_data = '';
$image_width = 0;
$attachment_id = 0;


$description = '';
if( !empty( $content ) ) :
	$description = $content;
elseif( !empty( $atts['description'] ) ) :
	$description = $atts['description'];
endif;


/* Thumbnails */
if( isset( $atts['image_ratio'] ) ) :
	if( $atts['image_ratio'] == 'portrait' ) :
		$image_ratio = 'jevelin-portrait';
	elseif( $atts['image_ratio'] == 'square' ) :
		$image_ratio = 'jevelin-square';
	else :
		$image_ratio = 'post-thumbnail';
	endif;
else :
	$image_ratio = 'post-thumbnail';
endif;

/* Icons */
/* Facebook */
if( isset($atts['facebook']) && $atts['facebook'] ) :
	$icons[] = array( 'name' => 'social-facebook', 'link' => esc_attr( $atts['facebook'] ) );
endif;
/* Twitter */
if( isset($atts['twitter']) && $atts['twitter'] ) :
	$icons[] = array( 'name' => 'social-twitter', 'link' => esc_attr( $atts['twitter'] ) );
endif;
/* Instagram */
if( isset($atts['instagram']) && $atts['instagram'] ) :
	$icons[] = array( 'name' => 'social-instagram', 'link' => esc_attr( $atts['instagram'] ) );
endif;
/* Skype */
if( isset($atts['skype']) && $atts['skype'] ) :
	$icons[] = array( 'name' => 'social-skype', 'link' => esc_attr( $atts['skype'] ) );
endif;
/* Behance */
if( isset($atts['behance']) && $atts['behance'] ) :
	$icons[] = array( 'name' => 'social-behance', 'link' => esc_attr( $atts['behance'] ) );
endif;
/* Linkedin */
if( isset($atts['linkedin']) && $atts['linkedin'] ) :
	$icons[] = array( 'name' => 'social-linkedin', 'link' => esc_attr( $atts['linkedin'] ) );
endif;
/*Tumblr */
if( isset($atts['tumblr']) && $atts['tumblr'] ) :
	$icons[] = array( 'name' => 'social-tumblr', 'link' => esc_attr( $atts['tumblr'] ) );
endif;

if( count( $icons) ) :
	$icons_data.= '<div class="sh-team-icons sh-team-icons-'.esc_attr( $icon_style ).'"><div class="sh-team-icons-container">';
	foreach( $icons as $icon ) :
		$icons_data.= '<a href="'.esc_url( $icon['link'] ).'" target="_blank" class="sh-team-icon">
			<div class="sh-team-icon-container">
				<i class="icon-'.esc_attr( $icon['name'] ).'"></i>
			</div>
		</a>';
	endforeach;


	if( !empty( $atts['tiktok'] ) ) :
		$icons_data.= '<a href="'.esc_url( $icon['link'] ).'" target="_blank" class="sh-team-icon">
			<div class="sh-team-icon-container">
				<div class="sh-team-icon-tiktok">
					<i class="icon-social-facebook">
						<svg width="512px" height="512px" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg"><path d="M412.19,118.66a109.27,109.27,0,0,1-9.45-5.5,132.87,132.87,0,0,1-24.27-20.62c-18.1-20.71-24.86-41.72-27.35-56.43h.1C349.14,23.9,350,16,350.13,16H267.69V334.78c0,4.28,0,8.51-.18,12.69,0,.52-.05,1-.08,1.56,0,.23,0,.47-.05.71,0,.06,0,.12,0,.18a70,70,0,0,1-35.22,55.56,68.8,68.8,0,0,1-34.11,9c-38.41,0-69.54-31.32-69.54-70s31.13-70,69.54-70a68.9,68.9,0,0,1,21.41,3.39l.1-83.94a153.14,153.14,0,0,0-118,34.52,161.79,161.79,0,0,0-35.3,43.53c-3.48,6-16.61,30.11-18.2,69.24-1,22.21,5.67,45.22,8.85,54.73v.2c2,5.6,9.75,24.71,22.38,40.82A167.53,167.53,0,0,0,115,470.66v-.2l.2.2C155.11,497.78,199.36,496,199.36,496c7.66-.31,33.32,0,62.46-13.81,32.32-15.31,50.72-38.12,50.72-38.12a158.46,158.46,0,0,0,27.64-45.93c7.46-19.61,9.95-43.13,9.95-52.53V176.49c1,.6,14.32,9.41,14.32,9.41s19.19,12.3,49.13,20.31c21.48,5.7,50.42,6.9,50.42,6.9V131.27C453.86,132.37,433.27,129.17,412.19,118.66Z" fill="currentColor" /></svg>
					</i>
				</div>
			</div>
		</a>';
	endif;


	$icons_data.= '</div></div>';

	$image_position = 'sh-team-image-position';
else :
	$image_position = '';
endif;

if( $image ) :
	if( !empty( $image['id'] ) ) :
		$image_lightbox = jevelin_image_url_by_id( $image['id'], 'large' );
		$image = jevelin_image_url_by_id( $image['id'], $image_ratio );
	elseif( jevelin_is_url( $image ) ) :
		$image_lightbox = $image;
		$image = $image;
	else :
		$image_lightbox = ( $image && !is_array( $image ) ) ? jevelin_get_small_thumb( $image, 'large' ) : jevelin_get_small_thumb( $image['attachment_id'], 'large' );
		$image = ( $image && !is_array( $image ) ) ? jevelin_get_small_thumb( $image, $image_ratio ) : jevelin_get_small_thumb( $image['attachment_id'], $image_ratio );
	endif;
endif;


/* Lazy Loading */
$lazy = jevelin_element_lazy_option( $atts );
if( $lazy ) :
	if( isset( $atts['image']['attachment_id'] ) ) :
		$attachment_id = $atts['image']['attachment_id'];
	elseif( isset( $atts['image'] ) && is_numeric( $atts['image'] ) ) :
		$attachment_id = $atts['image'];
	endif;

	if( $attachment_id ) :
		$image_media = wp_get_attachment_metadata( $attachment_id );

		if( $image_ratio ) :
			$image_width = ( isset( $image_media['sizes'][$image_ratio]['width'] ) ) ? $image_media['sizes'][$image_ratio]['width'] : 0;
			$image_height = ( isset( $image_media['sizes'][$image_ratio]['height'] ) ) ? $image_media['sizes'][$image_ratio]['height'] : 0;
		endif;
		if( !isset( $image_width ) || !$image_width ) :
			$image_width = ( isset( $image_media['width'] ) ) ? $image_media['width'] : 0;
			$image_height = ( isset( $image_media['height'] ) ) ? $image_media['height'] : 0;
		endif;

		$ratio = 0;
		if( $image_width ) :
			$ratio = ( $image_height / $image_width ) * 100;
		endif;
	endif;
endif;
?>

<div class="sh-team sh-team-<?php echo esc_attr( $layout ); ?> sh-team-social-<?php echo esc_attr( $icon_style ); ?>" id="team-<?php echo esc_attr( $id ); ?>">
	<?php if( $layout == 'style3' ) : ?>

		<div class="sh-team-image-container">
			<div class="sh-team-image">
				<a href="<?php echo esc_url( $image_lightbox ); ?>" class="<?php echo esc_attr( $image_position ); ?>" rel="lightbox">
					<?php if( $lazy && $image_width > 0 && $ratio ) :?>
						<div class="ratio-container" style="padding-top: <?php echo esc_attr( $ratio ); ?>%;">
							<div class="ratio-content">
								<img class="sh-image-url lazy" data-src="<?php echo esc_url( $image ); ?>" alt="" />
							</div>
						</div>
					<?php else : ?>
						<img src="<?php echo esc_url( $image ); ?>" alt="" />
					<?php endif; ?>
				</a>

				<?php if( $icon_style == 'overlay' ) : ?>
					<div class="sh-team-overlay">
						<?php echo ( $icons_data ); ?>
					</div>
				<?php elseif( $icon_style == 'overlay2' ) : ?>
					<div class="sh-team-overlay2">
						<?php echo ( $icons_data ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="sh-team-aside">
			<div class="sh-team-role">
				<?php echo esc_attr( $role ); ?>
			</div>
			<div class="sh-team-name">
				<h3><?php echo esc_attr( $name ); ?></h3>
			</div>
			<?php if( $description ) : ?>
				<div class="sh-team-description">
					<?php echo wp_kses_post( $description ); ?>
				</div>
			<?php endif; ?>
			<?php /* Social icons */ echo ( $icon_style == 'standard' ) ? $icons_data : ''; ?>
		</div>

	<?php elseif( $layout == 'style2' ) : ?>

		<div class="sh-team-top">
			<div class="sh-team-name">
				<h3><?php echo esc_attr( $name ); ?></h3>
			</div>
			<div class="sh-team-role">
				<?php echo esc_attr( $role); ?>
			</div>
		</div>

		<div class="sh-team-image">
			<a href="<?php echo esc_url( $image_lightbox ); ?>" class="<?php echo esc_attr( $image_position ); ?>" rel="lightbox">
				<?php if( $lazy && $image_width > 0 && $ratio ) :?>
					<div class="ratio-container" style="padding-top: <?php echo esc_attr( $ratio ); ?>%;">
						<div class="ratio-content">
							<img class="sh-image-url lazy" data-src="<?php echo esc_url( $image ); ?>" alt="" />
						</div>
					</div>
				<?php else : ?>
					<img src="<?php echo esc_url( $image ); ?>" alt="" />
				<?php endif; ?>
			</a>

			<?php if( $icon_style == 'overlay' ) : ?>
				<div class="sh-team-overlay">
					<?php echo ( $icons_data ); ?>
				</div>
			<?php elseif( $icon_style == 'overlay2' ) : ?>
				<div class="sh-team-overlay2">
					<?php echo ( $icons_data ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="sh-team-aside">
			<?php if( $description ) : ?>
				<div class="sh-team-description">
					<?php echo wp_kses_post( $description ); ?>
				</div>
			<?php endif; ?>
			<?php /* Social icons */ echo ( $icon_style == 'standard' ) ? $icons_data : ''; ?>
		</div>

	<?php else : ?>

		<div class="sh-team-image">
			<a href="<?php echo esc_url( $image_lightbox ); ?>" class="<?php echo esc_attr( $image_position ); ?>" rel="lightbox">
				<?php if( $lazy && $image_width > 0 && $ratio ) :?>
					<div class="ratio-container" style="padding-top: <?php echo esc_attr( $ratio ); ?>%;">
						<div class="ratio-content">
							<img class="sh-image-url lazy" data-src="<?php echo esc_url( $image ); ?>" alt="" />
						</div>
					</div>
				<?php else : ?>
					<img src="<?php echo esc_url( $image ); ?>" alt="" />
				<?php endif; ?>
			</a>

			<?php if( $icon_style == 'overlay' ) : ?>
				<div class="sh-team-overlay">
					<?php echo ( $icons_data ); ?>
				</div>
			<?php elseif( $icon_style == 'overlay2' ) : ?>
				<div class="sh-team-overlay2">
					<?php echo ( $icons_data ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="sh-team-aside">
			<div class="sh-team-name">
				<h3><?php echo esc_attr( $name ); ?></h3>
			</div>
			<div class="sh-team-role">
				<?php echo esc_attr( $role ); ?>
			</div>

			<?php if( $description ) : ?>
				<div class="sh-team-description">
					<?php echo wp_kses_post( $description ); ?>
				</div>
			<?php endif; ?>

			<?php /* Social icons */ echo ( $icon_style == 'standard' ) ? $icons_data : ''; ?>
		</div>

	<?php endif; ?>
</div>
