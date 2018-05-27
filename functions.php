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
 include("/custom-modules/custom-latest-case-studies.php");
 include("/custom-modules/custom-latest-resources.php");
 include("/custom-modules/custom-resources-page.php");
 include("/custom-modules/custom-blog-page.php");
 include("/custom-modules/custom-portfolio-big.php");
 include("/custom-modules/custom-portfolio-small-1.php");
 include("/custom-modules/custom-portfolio-small-2.php");
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