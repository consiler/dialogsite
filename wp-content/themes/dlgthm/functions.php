<?php
/*
* 
*               .-://:-`       `:+oso+-`       `-://:-.                
*             -+ooooooo+:`   `+hdddddddh/    `/+ooooooo+.              
*            .ooooooooooo/   oddddddddddd/   +ooooooooooo.             
*            /oooooooooooo`  ddddddddddddy  `oooooooooooo:             
*            -ooooooooooo/   sddddddddddd+   +ooooooooooo.             
*             -+ooooooo+/`   `oddddddddh+`   `/oooooooo+-              
*              `.:///:-`       ./osyso:.       `-:///:.`               
*                                                                                                                                            
*                                                                      
*                     
* `+/:::::::/-`     :/                 -+                              
* `o:       `-+:    ``                 :o                              
* `o:         .o-   -:    `-::::::.    :o     `-:::::-`     `.:::::.`:.
* `o:          ++   /+   `+/`   `-+.   :o    :+-`  ``:+.   `//.`  `-/o-
* `o:          /o   /+   `.`  ```.o-   :o   .o.       :o`  /+       -o-
* `o:          +/   /+    .::::---o-   :o   :o        .o-  o:       .o-
* `o:         :o.   /+   /+.`    `o-   :o   -o.       -o`  /+       :o-
* `o:```````-//.    /+   /+`   `.:o:`  :o    :+.`   `-+-   `//.```.:/o-
* `//:::::::-.      ::   `:/::::-`-/-  -/     .::::::-`      .-:::-..o.
*                                                         ./`      :+` 
*                                                          -/:----//.  
*                                                            `....`   
*/

/**
 * Settings
 */
define('THUMB_W', 604);
define('THUMB_H', 270);
define('ATTACHED_IMG_W', 604);
define('ATTACHED_IMG_H', 270);
define('CROP_THUMBS', true);

/**
 * Sets max width for page content like images, etc.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Dialog Theme supports.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 * @since Dialog 0.1
 * @return void
 */
function dialog_setup() {
	// Adds RSS info in head
	add_theme_support('automatic-feed-links');

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	register_nav_menu( 'primary', 'Navigation Menu');
	
	//custom img size for featured img, disp. on std. posts/pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(THUMB_W, THUMB_H, CROP_THUMBS);

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses its own gallery styles.
	//To be safely removed later.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action('after_setup_theme', 'dialog_setup');

/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function dialog_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry, a JS library for displaying a bunch of boxes with dynamic layout
	// Also responsive
	// Need to add a conditional here to only display when we need it.
	wp_enqueue_script('jquery-masonry');

	// Loads theme JS
	wp_enqueue_script('twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '0.1', true);

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style('genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09');

	// Loads our theme stylesheet.
	wp_enqueue_style('dialog-style', get_stylesheet_uri(), array(), '2013-07-18');

	//Loads our actual stylesheet.
	wp_enqueue_style('dialog-main-style', get_template_directory_uri() . '/css/main.min.css', array(), '0.1');

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '0.1' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'dialog_scripts_styles' );

/**
 * Widgets.
 * @return void
 */
function dialog_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'dialog_widgets_init' );

if ( ! function_exists( 'dialog_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function dialog_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'dialog_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
* @return void
*/
function dialog_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'dialog_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 * @return void
 */
function dialog_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">Sticky</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		dialog_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'dialog_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function dialog_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'dialog' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf('Permalink to %s', the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'dialog_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 * @return void
 */
function dialog_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'dialog_attachment_size', array(ATTACHED_IMG_W, ATTACHED_IMG_H));
	$next_attachment_url = wp_get_attachment_url();
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts(array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	));

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns the URL from the post.
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 * Falls back to the post permalink if no URL is found in the post.
 * @return string The Link format URL.
 */
function dialog_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function dialog_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'dialog_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 * @return void
 */

function dialog_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'dialog_content_width' );

$libdir = "lib/";
require_once(locate_template($libdir.'template-wrapper.php'));
require_once(locate_template($libdir.'cpt.php'));