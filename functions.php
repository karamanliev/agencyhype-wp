<?php
/*================================================
# Enqueue custom styles and js file
================================================*/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_files' );
function theme_enqueue_files() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    // wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/css/styles-b.css' );
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
}

/*================================================
# Add Typekit Fonts
================================================*/
function theme_typekit() {
    wp_enqueue_script( 'theme_typekit', '//use.typekit.net/cbw6ltu.js');
}
add_action( 'wp_enqueue_scripts', 'theme_typekit' );

function theme_typekit_inline() {
  if ( wp_script_is( 'theme_typekit', 'done' ) ) { ?>
  	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php }
}
add_action( 'wp_head', 'theme_typekit_inline' );


/*================================================
# LOAD CUSTOM MODULES
================================================*/
function Custom_Modules(){
 if(class_exists("ET_Builder_Module")){
 include "custom-modules/custom-latest-case-studies.php";
 include "custom-modules/custom-latest-resources.php";
 include "custom-modules/custom-resources-page.php";
 include "custom-modules/custom-blog-page.php";
 include "custom-modules/custom-portfolio-big.php";
 include "custom-modules/custom-portfolio-small-1.php";
 include "custom-modules/custom-portfolio-small-2.php";
//  include("/custom-modules/custom-project-header.php");
//  include("/custom-modules/custom-jumbotron-arrow.php");
 }
}

function Prep_Custom_Modules(){
 global $pagenow;

$is_admin = is_admin();
 $action_hook = $is_admin ? 'wp_loaded' : 'wp';
 $required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
 $specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
 $is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
 $is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
 $is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import']; 
 $is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];

if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
 add_action($action_hook, 'Custom_Modules', 9789);
 }
}
Prep_Custom_Modules();


/*================================================
# Enqueue Slick scripts and styles
================================================*/
add_action( 'wp_enqueue_scripts', 'slick_enqueue_scripts_styles' );
function slick_enqueue_scripts_styles() {
	wp_enqueue_script( 'slickjs', get_stylesheet_directory_uri() . '/js/vendor/slick.min.js', array( 'jquery' ), '1.8.1', true );
	wp_enqueue_script( 'slickjs-init', get_stylesheet_directory_uri(). '/js/slick-init.js', array( 'slickjs' ), '1.8.1', true );
	// wp_enqueue_style( 'slickcss', get_stylesheet_directory_uri() . '/css/slick.css', '1.8.1', 'all');
	// wp_enqueue_style( 'slickcsstheme', get_stylesheet_directory_uri(). '/css/slick-theme.css', '1.8.1', 'all');
}

/*================================================
# Add page slug to body class
================================================*/
function add_slug_body_class( $classes ) {
    global $post;
        if ( isset( $post ) ) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }
        return $classes;
    }
add_filter( 'body_class', 'add_slug_body_class' );

/*================================================
# Reduce Posts Count for Case Studies Page 
# Needed for offset and pagination to work OK
================================================*/
add_filter('found_posts', 'adjust_offset_pagination', 1, 2 );
function adjust_offset_pagination($found_posts, $query) {
    if ( $query->get( 'offsetreduced' ) ) {
        return $found_posts - 3;
    }
    return $found_posts;
}

/*================================================
# Add class to next/previous post links 
# first function is for blog & case studies
# second function is for single case study
================================================*/
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn btn-more"';
}

add_filter('next_post_link', 'project_nextprev_link_attributes');
add_filter('previous_post_link', 'project_nextprev_link_attributes');
 
function project_nextprev_link_attributes($output) {
    $code = 'class="svg-icon menu-arrow"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}

/*================================================
# Disable support for comments
================================================*/
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');
// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');
// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

/*================================================
# Hide resources from categories widget
================================================*/
function exclude_widget_categories($args){
    $exclude = "13";
    $args["exclude"] = $exclude;
    return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");