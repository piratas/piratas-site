<?php
/**
 * Theme Functions
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

function cyberchimps_text_domain() {
	load_theme_textdomain( 'business-lite', get_template_directory() . '/inc/languages' );
}
add_action( 'after_setup_theme', 'cyberchimps_text_domain' );

// Load Core
require_once( get_template_directory() . '/cyberchimps/init.php' );

// Set the content width based on the theme's design and stylesheet.
if( !isset( $content_width ) ) {
	$content_width = 640;
} /* pixels */

function cyberchimps_add_site_info() {
	?>
	<p>&copy; Company Name</p>
<?php
}

add_action( 'cyberchimps_site_info', 'cyberchimps_add_site_info' );

if( !function_exists( 'cyberchimps_comment' ) ) :
// Template for comments and pingbacks.
// Used as a callback by wp_list_comments() for displaying the comments.

	function cyberchimps_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
				<p><?php _e( 'Pingback:', 'business-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'business-lite' ), ' ' ); ?></p>
				<?php
				break;
			default :
				?>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment hreview">
						<footer>
							<div class="comment-author reviewer vcard">
								<?php echo get_avatar( $comment, 40 ); ?>
								<?php printf( '%s <span class="says">' . __( 'says:', 'business-lite' ) . '</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
							</div>
							<!-- .comment-author .vcard -->
							<?php if( $comment->comment_approved == '0' ) : ?>
								<em><?php _e( 'Your comment is awaiting moderation.', 'business-lite' ); ?></em>
								<br/>
							<?php endif; ?>

							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="dtreviewed">
									<time pubdate datetime="<?php comment_time( 'c' ); ?>">
										<?php
										/* translators: 1: date, 2: time */
										printf( __( '%1$s', 'business-lite' ), get_comment_date( 'm / d / y' ) ); ?>
									</time>
								</a>
								<?php edit_comment_link( __( '(Edit)', 'business-lite' ), ' ' );
								?>
							</div>
							<!-- .comment-meta .commentmetadata -->
						</footer>

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div>
						<!-- .reply -->
					</article><!-- #comment-## -->

				<?php
				break;
		endswitch;
	}
endif; // ends check for cyberchimps_comment()

// set up next and previous post links for lite themes only
function cyberchimps_next_previous_posts() {
	if( get_next_posts_link() || get_previous_posts_link() ): ?>
		<div class="more-content">
			<div class="row-fluid">
				<div class="span6 previous-post">
					<?php previous_posts_link(); ?>
				</div>
				<div class="span6 next-post">
					<?php next_posts_link(); ?>
				</div>
			</div>
		</div>
	<?php
	endif;
}

add_action( 'cyberchimps_after_content', 'cyberchimps_next_previous_posts' );

// core options customization Names and URL's
//Pro or Free
function cyberchimps_theme_check() {
	$level = 'free';

	return $level;
}

//Theme Name
function cyberchimps_options_theme_name() {
	$text = 'Business Lite';

	return $text;
}

//Pro version name
function cyberchimps_upgrade_bar_pro_title() {
	$text = 'Business Pro';

	return $text;
}

//Pro version link
function cyberchimps_options_pro_link() {
	$url = 'http://cyberchimps.com/store/business-pro/';

	return $url;
}

//Doc's URL
function cyberchimps_options_documentation_url() {
	$url = 'http://cyberchimps.com/guides/';

	return $url;
}

// Support Forum URL
function cyberchimps_options_support_forum() {
	$url = 'http://cyberchimps.com/forum/free/business/';

	return $url;
}

// Slider Options Help URL
function cyberchimps_options_slider_options_help() {
	$url = 'http://cyberchimps.com/faq/how-to-use-the-ifeature-pro-slider/';

	return $url;
}

add_filter( 'cyberchimps_current_theme_name', 'cyberchimps_options_theme_name', 1 );
add_filter( 'cyberchimps_upgrade_pro_title', 'cyberchimps_upgrade_bar_pro_title' );
add_filter( 'cyberchimps_upgrade_link', 'cyberchimps_options_pro_link' );
add_filter( 'cyberchimps_documentation', 'cyberchimps_options_documentation_url' );
add_filter( 'cyberchimps_support_forum', 'cyberchimps_options_support_forum' );
add_filter( 'cyberchimps_slider_options_help', 'cyberchimps_options_slider_options_help' );

// Help Section
function cyberchimps_options_help_header() {
	$text = 'Business Lite';

	return $text;
}

function cyberchimps_options_help_sub_header() {
	$text = __( 'Professional Business Theme', 'business-lite' );

	return $text;
}

add_filter( 'cyberchimps_help_heading', 'cyberchimps_options_help_header' );
add_filter( 'cyberchimps_help_sub_heading', 'cyberchimps_options_help_sub_header' );

// Branding images and defaults

// Slider Defaults
function cyberchimps_default_slider2() {
	$image = '/images/branding/slide2.jpg';

	return $image;
}

function cyberchimps_default_slider3() {
	$image = '/images/branding/slide3.jpg';

	return $image;
}

add_filter( 'cyberchimps_slider_lite_img2', 'cyberchimps_default_slider2' );
add_filter( 'cyberchimps_slider_lite_img3', 'cyberchimps_default_slider3' );

//theme specific skin options in array. Must always include option default
//todo clean up function
function cyberchimps_skin_color_options( $options ) {
	// Get path of image
	$imagepath = get_template_directory_uri() . '/inc/css/skins/images/';

	$options = array(
		'default' => $imagepath . 'default.png'
	);

	return $options;
}

add_filter( 'cyberchimps_skin_color', 'cyberchimps_skin_color_options', 1 );

// theme specific background images
function cyberchimps_background_image( $options ) {
	$imagepath = get_template_directory_uri() . '/cyberchimps/lib/images/';
	$options   = array(
		'none'  => $imagepath . 'backgrounds/thumbs/none.png',
		'noise' => $imagepath . 'backgrounds/thumbs/noise.png',
		'blue'  => $imagepath . 'backgrounds/thumbs/blue.png',
		'dark'  => $imagepath . 'backgrounds/thumbs/dark.png',
		'space' => $imagepath . 'backgrounds/thumbs/space.png'
	);

	return $options;
}

add_filter( 'cyberchimps_background_image', 'cyberchimps_background_image' );

// theme specific typography options
function cyberchimps_typography_sizes( $sizes ) {
	$sizes = array( '8', '9', '10', '12', '14', '16', '20' );

	return $sizes;
}

function cyberchimps_typography_faces( $faces ) {
	$faces = array(
		'Arial, Helvetica, sans-serif'                     => 'Arial',
		'Arial Black, Gadget, sans-serif'                  => 'Arial Black',
		'Comic Sans MS, cursive'                           => 'Comic Sans MS',
		'Courier New, monospace'                           => 'Courier New',
		'Georgia, serif'                                   => 'Georgia',
		'Impact, Charcoal, sans-serif'                     => 'Impact',
		'Lucida Console, Monaco, monospace'                => 'Lucida Console',
		'Lucida Sans Unicode, Lucida Grande, sans-serif'   => 'Lucida Sans Unicode',
		'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype',
		'Tahoma, Geneva, sans-serif'                       => 'Tahoma',
		'Times New Roman, Times, serif'                    => 'Times New Roman',
		'Trebuchet MS, sans-serif'                         => 'Trebuchet MS',
		'Verdana, Geneva, sans-serif'                      => 'Verdana',
		'Symbol'                                           => 'Symbol',
		'Webdings'                                         => 'Webdings',
		'Wingdings, Zapf Dingbats'                         => 'Wingdings',
		'MS Sans Serif, Geneva, sans-serif'                => 'MS Sans Serif',
		'MS Serif, New York, serif'                        => 'MS Serif',
	);

	return $faces;
}

function cyberchimps_typography_styles( $styles ) {
	$styles = array( 'normal' => 'Normal', 'bold' => 'Bold' );

	return $styles;
}

add_filter( 'cyberchimps_typography_sizes', 'cyberchimps_typography_sizes' );
add_filter( 'cyberchimps_typography_faces', 'cyberchimps_typography_faces' );
add_filter( 'cyberchimps_typography_styles', 'cyberchimps_typography_styles' );

//image size for the blog page 
add_image_size( 'blog-page', 1500, 200, true ); //830 pixels wide and 180 pixels tall

//change cyberchimps featured image to use this new image size
function cyberchimps_featured_image_size() {
	return 'blog-page';
}

add_filter( 'cyberchimps_post_thumbnail_size', 'cyberchimps_featured_image_size' );

//Register Secondary Menu
function cyberchimps_secondary_menu() {
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'business-lite' ) );
}

add_action( 'init', 'cyberchimps_secondary_menu' );

/******************************************
 ************** Custom meta data **********
 ******************************************/
//Get the meta date
function cyberchimps_posted_on() {

	if( is_single() ) {
		$show_date = ( cyberchimps_get_option( 'single_post_byline_date', 1 ) ) ? cyberchimps_get_option( 'single_post_byline_date', 1 ) : false;
	}
	elseif( is_archive() ) {
		$show_date = ( cyberchimps_get_option( 'archive_post_byline_date', 1 ) ) ? cyberchimps_get_option( 'archive_post_byline_date', 1 ) : false;
	}
	else {
		$show_date = ( cyberchimps_get_option( 'post_byline_date', 1 ) ) ? cyberchimps_get_option( 'post_byline_date', 1 ) : false;
	}

	$posted_on = sprintf( '<span class="meta-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date updated" datetime="%3$s">%4$s</time></a></span>',
	                      esc_url( get_permalink() ),
	                      esc_attr( get_the_time() ),
	                      esc_attr( get_the_date( 'c' ) ),
	                      ( $show_date ) ? esc_html( get_the_date() ) : ''
	);

	if( $show_date ) {
		apply_filters( 'cyberchimps_posted_on', $posted_on );
		echo $posted_on;
	}
}

//Get the meta author
function cyberchimps_posted_by() {

	if( is_single() ) {
		$show_author = ( cyberchimps_get_option( 'single_post_byline_author', 1 ) ) ? cyberchimps_get_option( 'single_post_byline_author', 1 ) : false;
	}
	elseif( is_archive() ) {
		$show_author = ( cyberchimps_get_option( 'archive_post_byline_author', 1 ) ) ? cyberchimps_get_option( 'archive_post_byline_author', 1 ) : false;
	}
	else {
		$show_author = ( cyberchimps_get_option( 'post_byline_author', 1 ) ) ? cyberchimps_get_option( 'post_byline_author', 1 ) : false;
	}

	$posted_by = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
	                      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	                      esc_attr( sprintf( __( 'View all posts by %s', 'cyberchimps_core' ), get_the_author() ) ),
	                      ( $show_author ) ? esc_html( get_the_author() ) : ''
	);

	if( $show_author ) {
		apply_filters( 'cyberchimps_posted_by', $posted_by );
		echo $posted_by;
	}
}

//categories
function cyberchimps_posted_in() {
	global $post;

	if( is_single() ) {
		$show = ( cyberchimps_get_option( 'single_post_byline_categories', 1 ) ) ? cyberchimps_get_option( 'single_post_byline_categories', 1 ) : false;
	}
	elseif( is_archive() ) {
		$show = ( cyberchimps_get_option( 'archive_post_byline_categories', 1 ) ) ? cyberchimps_get_option( 'archive_post_byline_categories', 1 ) : false;
	}
	else {
		$show = ( cyberchimps_get_option( 'post_byline_categories', 1 ) ) ? cyberchimps_get_option( 'post_byline_categories', 1 ) : false;
	}
	if( $show ):
		$categories_list = get_the_category_list( ', ' );
		if( $categories_list ) :
			$cats = $categories_list;
			?>
			<span class="cat-links">
        <?php echo apply_filters( 'cyberchimps_post_categories', $cats ); ?>
      </span>
		<?php endif;
	endif;
}

//Post coments
function cyberchimps_post_comments() {
	global $post;

	if( is_single() ) {
		$show = ( cyberchimps_get_option( 'single_post_byline_comments', 1 ) ) ? cyberchimps_get_option( 'single_post_byline_comments', 1 ) : false;
	}
	elseif( is_archive() ) {
		$show = ( cyberchimps_get_option( 'archive_post_byline_comments', 1 ) ) ? cyberchimps_get_option( 'archive_post_byline_comments', 1 ) : false;
	}
	else {
		$show = ( cyberchimps_get_option( 'post_byline_comments', 1 ) ) ? cyberchimps_get_option( 'post_byline_comments', 1 ) : false;
	}
	$leave_comment = ( is_single() || is_page() ) ? '' : __( 'Leave a comment', 'cyberchimps_core' );
	if( $show ):
		if( !post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( $leave_comment, __( '1 Comment', 'cyberchimps_core' ), '% ' . __( 'Comments', 'cyberchimps_core' ) ); ?></span>
		<?php endif;
	endif;
}

/******************************************
 ********** End Custom meta data **********
 ******************************************/

//Create secondary menu page title
function cyberchimps_secondary_menu_title() {
	if( is_home() || is_single() ) {
		$title = __( 'Our Blog', 'business-lite' );
	}
	elseif( is_page() && get_post_meta( get_the_ID(), 'cyberchimps_page_title_toggle', true ) == 1 ) {
		$title = esc_html( get_the_title() );
	}
	elseif( is_category() ) {
		$title = sprintf( __( 'Category Archives: %s', 'business-lite' ), '<span>' . single_cat_title( '', false ) . '</span>' );

	}
	elseif( is_tag() ) {
		$title = sprintf( __( 'Tag Archives: %s', 'business-lite' ), '<span>' . single_tag_title( '', false ) . '</span>' );

	}
	elseif( is_author() ) {
		/* Queue the first post, that way we know
		 * what author we're dealing with (if that is the case).
		*/
		the_post();
		$title = sprintf( __( 'Author Archives: %s', 'business-lite' ), '<span>' . get_the_author() . '</span>' );
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();

	}
	elseif( is_day() ) {
		$title = sprintf( __( 'Daily Archives: %s', 'business-lite' ), '<span>' . get_the_date() . '</span>' );

	}
	elseif( is_month() ) {
		$title = sprintf( __( 'Monthly Archives: %s', 'business-lite' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

	}
	elseif( is_year() ) {
		$title = sprintf( __( 'Yearly Archives: %s', 'business-lite' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

	}
	elseif( is_search() ) {
		$title = sprintf( __( 'Search Results for: %s', 'business-lite' ), '<span>' . get_search_query() . '</span>' );
	}
	else {
		$title = '';
	}

	return $title;
}

// header drag and drop default
function cyberchimps_business_lite_header_drag_and_drop_default() {
	$option = array( 'cyberchimps_logo' => __( 'Logo', 'cyberchimps_elements' )
	);

	return $option;
}

add_filter( 'header_drag_and_drop_default', 'cyberchimps_business_lite_header_drag_and_drop_default', 20 );

//add header drag and drop options
function cyberchimps_business_lite_header_drag_and_drop_options() {
	$options = array(
		'cyberchimps_sitename_register' => __( 'Logo + Login', 'cyberchimps_elements' ),
		'cyberchimps_logo_search'       => __( 'Logo + Search', 'cyberchimps_elements' ),
		'cyberchimps_logo'              => __( 'Logo', 'cyberchimps_elements' )
	);

	return $options;
}

add_filter( 'header_drag_and_drop_options', 'cyberchimps_business_lite_header_drag_and_drop_options', 15 );

//Create header drag and drop display on frontend
function cyberchimps_header_display() {

	//get selected header elements
	$selected = cyberchimps_get_option( 'header_section_order' );

	//loop through results and display
	if( is_array( $selected ) ) {
		foreach( $selected as $value ) {
			switch( $value ) {
				case 'cyberchimps_logo_search':
					?>
					<div class="header-search">
						<?php get_search_form( true ); ?>
					</div>
					<?php
					break;
				case 'cyberchimps_sitename_contact':
					cyberchimps_contact_info();
					break;
				case 'cyberchimps_sitename_register':
					?>
					<div class="register">
						<?php
						if( !is_user_logged_in() ) :
							wp_loginout(); ?> <?php wp_meta(); ?> | <?php wp_register( '', '', true );
						else :?>
							Welcome back <strong><?php global $current_user;
								get_currentuserinfo();
								echo( $current_user->user_login ); ?></strong> | <?php wp_loginout(); ?>
						<?php endif; ?>
					</div>
					<?php
					break;
				default:

					break;
			}
		}
	}
}

add_action( 'cyberchimps_header_display', 'cyberchimps_header_display' );

// Places icons in footer if there are any
function cyberchimps_footer_social() {

	$twitter_display    = cyberchimps_get_option( 'social_twitter', 'checked' );
	$facebook_display   = cyberchimps_get_option( 'social_facebook', 'checked' );
	$google_display     = cyberchimps_get_option( 'social_google', 'checked' );
	$flickr_display     = cyberchimps_get_option( 'social_flickr' );
	$pinterest_display  = cyberchimps_get_option( 'social_pinterest' );
	$linkedin_display   = cyberchimps_get_option( 'social_linkedin' );
	$youtube_display    = cyberchimps_get_option( 'social_youtube' );
	$googlemaps_display = cyberchimps_get_option( 'social_googlemaps' );
	$email_display      = cyberchimps_get_option( 'social_email' );
	$rss_display        = cyberchimps_get_option( 'social_rss' );

	if( !empty( $twitter_display ) || !empty( $facebook_display ) || !empty( $google_display ) || !empty( $flickr_display ) || !empty( $pinterest_display ) || !empty( $linkedin_display ) || !empty( $youtube_display ) || !empty( $googlemaps_display ) || !empty( $email_display ) || !empty( $rss_display ) ): ?>
		<div class="container-full-width" id="footer_social_icons">
			<div class="container">
				<div class="container-fluid">
					<div class="row-fluid">
						<?php cyberchimps_header_social_icons(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif;
}

add_action( 'cyberchimps_before_footer_container', 'cyberchimps_footer_social' );
?>