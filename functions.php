<?php
/**
 * Skeleton functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, Skeleton_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'Skeleton_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since Skeleton 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run Skeleton_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'Skeleton_setup' );

if ( ! function_exists( 'Skeleton_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override Skeleton_setup() in a child theme, add your own Skeleton_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Skeleton 0.1
 */
function Skeleton_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'Skeleton', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'Skeleton' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/3.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to Skeleton_header_image_width and Skeleton_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'Skeleton_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'Skeleton_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See Skeleton_admin_header_style(), below.
	add_custom_image_header( '', 'Skeleton_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'1' => array(
			'url' => '%s/images/headers/1.jpg',
			'thumbnail_url' => '%s/images/headers/1-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '1', 'Skeleton' )
		),
		'2' => array(
			'url' => '%s/images/headers/2.jpg',
			'thumbnail_url' => '%s/images/headers/2-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '2', 'Skeleton' )
		),
		'3' => array(
			'url' => '%s/images/headers/3.jpg',
			'thumbnail_url' => '%s/images/headers/3-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '3', 'Skeleton' )
		),
		'4' => array(
			'url' => '%s/images/headers/4.jpg',
			'thumbnail_url' => '%s/images/headers/4-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '4', 'Skeleton' )
		),
		'5' => array(
			'url' => '%s/images/headers/5.jpg',
			'thumbnail_url' => '%s/images/headers/5-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '5', 'Skeleton' )
		),
		'6' => array(
			'url' => '%s/images/headers/6.jpg',
			'thumbnail_url' => '%s/images/headers/6-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '6', 'Skeleton' )
		),
		'7' => array(
			'url' => '%s/images/headers/7.jpg',
			'thumbnail_url' => '%s/images/headers/7-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '7', 'Skeleton' )
		),
		'8' => array(
			'url' => '%s/images/headers/8.jpg',
			'thumbnail_url' => '%s/images/headers/8-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( '8', 'Skeleton' )
		)
	) );
}
endif;

if ( ! function_exists( 'Skeleton_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in Skeleton_setup().
 *
 * @since Skeleton 0.1
 */
function Skeleton_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Skeleton 0.1
 */
function Skeleton_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'Skeleton_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Skeleton 0.1
 * @return int
 */
function Skeleton_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'Skeleton_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Skeleton 0.1
 * @return string "Continue Reading" link
 */
function Skeleton_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Skeleton' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and Skeleton_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Skeleton 0.1
 * @return string An ellipsis
 */
function Skeleton_auto_excerpt_more( $more ) {
	return ' &hellip;' . Skeleton_continue_reading_link();
}
add_filter( 'excerpt_more', 'Skeleton_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Skeleton 0.1
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function Skeleton_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= Skeleton_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'Skeleton_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Skeleton's style.css.
 *
 * @since Skeleton 0.1
 * @return string The gallery style filter, with the styles themselves removed.
 */
function Skeleton_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'Skeleton_remove_gallery_css' );

if ( ! function_exists( 'Skeleton_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own Skeleton_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Skeleton 0.1
 */
function Skeleton_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'Skeleton' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'Skeleton' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'Skeleton' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'Skeleton' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'Skeleton' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'Skeleton'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override Skeleton_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Skeleton 0.1
 * @uses register_sidebar
 */
function Skeleton_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'Skeleton' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'Skeleton' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	
	
	// Area 3, located in the header. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Header Widget Area', 'Skeleton' ),
		'id' => 'first-header-widget-area',
		'description' => __( 'The first header widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	
		// Area 4, located in the header. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Header Widget Area', 'Skeleton' ),
		'id' => 'second-header-widget-area',
		'description' => __( 'The second header widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	// Area 5, located in the header. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Header Widget Area', 'Skeleton' ),
		'id' => 'third-header-widget-area',
		'description' => __( 'The thirdt header widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	// Area 6, located in the header. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Header Widget Area', 'Skeleton' ),
		'id' => 'fourth-header-widget-area',
		'description' => __( 'The fourth header widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	
	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'Skeleton' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 8, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'Skeleton' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 9, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'Skeleton' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 10, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'Skeleton' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'Skeleton' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
}
/** Register sidebars by running Skeleton_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'Skeleton_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Skeleton 0.1
 */
function Skeleton_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'Skeleton_remove_recent_comments_style' );

if ( ! function_exists( 'Skeleton_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Skeleton 0.1
 */
function Skeleton_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'Skeleton' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'Skeleton' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'Skeleton_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Skeleton 0.1
 */
function Skeleton_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Skeleton' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Skeleton' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Skeleton' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
