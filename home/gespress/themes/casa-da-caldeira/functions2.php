<?php 

/**
 * biss functions and definitions
 */
global $theme_option;
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' );
}

 require_once dirname( __FILE__ ) . '/framework/bfi_thumb-master/BFI_Thumb.php';	
 require_once dirname( __FILE__ ) . '/framework/meta-boxes.php';
 require_once dirname( __FILE__ ) . '/shortcodes.php';
 require_once dirname( __FILE__ ) . '/framework/widget/widget.php';
 require_once dirname( __FILE__ ) . '/framework/wp_bootstrap_navwalker.php'; 

 function biss_setup() {
    global $content_width;

    /* Set the $content_width for things such as video embeds. */
    if ( ! isset( $content_width ) ) 
        $content_width = 900;

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on cubic, use a find and replace
     * to change 'cubic' to the name of your theme in all the template files
     */	
    load_theme_textdomain( 'biss', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.p
	add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-header' );
    add_theme_support( "title-tag" );
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'biss-full-width', 1038, 576, true );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery', 'quote', 'image') );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'biss_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
    add_shortcode('gallery', '__return_false');
}
add_action( 'after_setup_theme', 'biss_setup' );

function biss_register_menu() {
  /* register menu. */  
  register_nav_menus( array(
		'primary'   => __( 'Primary menu', 'biss' ),        
		'top' => __( 'Top menu','biss' ),
        'secondary' => __( 'Footer menu','biss' ),
	) );
}
add_action( 'init', 'biss_register_menu' );

function biss_load_custom_wp_admin_style() {
    /* Enqueue custom CSS here using wp_enqueue_style(). */
    wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/framework/admin/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'biss_load_custom_wp_admin_style' );


// Reqire File Style and JS
function biss_theme_scripts_styles(){
	 global $theme_option;	
   	 $protocol = is_ssl() ? 'https' : 'http';

   	 /**** Google fonts ****/
     wp_enqueue_style( 'fonts-Nothing', "$protocol://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic", true);
     wp_enqueue_style( 'fonts-Yanone', "$protocol://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700", true);
     wp_enqueue_style( 'fonts-Archivo', "$protocol://fonts.googleapis.com/css?family=Archivo+Black", true);
	 
     /****Bootstrap****/
	 wp_enqueue_style( 'normalize-css', get_template_directory_uri().'/css/normalize.css','','3.2');
     wp_enqueue_style( 'colorbox-css', get_template_directory_uri().'/css/colorbox-skins/4/colorbox.css','','3.2');
	 wp_enqueue_style( 'animate-css', get_template_directory_uri().'/css/animate.css','','3.2');
	 wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css','','3.2');
	 wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/css/font-awesome/css/font-awesome.min.css','','3.2');           
     wp_enqueue_style( 'helpers-css', get_template_directory_uri().'/css/helpers.css','','3.2');
     wp_enqueue_style( 'component-css', get_template_directory_uri().'/css/component.css','','3.2');
     wp_enqueue_style( 'layerslider-css', get_template_directory_uri().'/css/layerslider/css/layerslider.css','','3.2');
     wp_enqueue_style( 'style', get_stylesheet_uri(), array(),'2015-05-05' );
     wp_enqueue_style( 'boxed', get_template_directory_uri().'/css/boxed.css','','3.2');    
	 wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css','','3.2');
     wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl.theme.css','','3.2');  

     /*Woocomerce Style*/
     wp_enqueue_style( 'woocommerce-theme', get_template_directory_uri().'/css/woocommerce.css');   
     
     /*theme option for color */
     wp_enqueue_style( 'color', get_template_directory_uri() .'/framework/color.php');

    /**** Bootstrap core and JavaScript's ****/
    wp_enqueue_script("jquery");
    wp_enqueue_script("twitterFetcher", get_template_directory_uri()."/js/twitterFetcher_min.js",array(),false,false);
    wp_enqueue_script("maps-js", "$protocol://maps.googleapis.com/maps/api/js?v=3.exp&hl=en&sensor=true",array(),false,true);
    wp_enqueue_script("modernizr-js", get_template_directory_uri()."/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js",array(),false,true);
    wp_enqueue_script("bootstrap", get_template_directory_uri()."/js/vendor/bootstrap.min.js",array(),false,true);
    wp_enqueue_script("imagesloaded", get_template_directory_uri()."/js/imagesloaded.pkgd.min.js",array(),false,false);
    wp_enqueue_script("masonry-js", get_template_directory_uri()."/js/masonry.pkgd.min.js",array(),false,false);
    wp_enqueue_script("less-js", get_template_directory_uri()."/js/less-1.7.4.min.js",array(),false,true);
	wp_enqueue_script("colorbox-js", get_template_directory_uri()."/js/jquery.colorbox-min.js",array(),false,true);
    wp_enqueue_script("fitvids", get_template_directory_uri()."/js/jquery.fitvids.js",array(),false,true);
	wp_enqueue_script("vide", get_template_directory_uri()."/js/jquery.vide.min.js",array(),false,true);
    wp_enqueue_script("easing-js", get_template_directory_uri()."/js/jquery.easing.1.3.js",array(),false,true);
	wp_enqueue_script("rivathemes-js", get_template_directory_uri()."/js/jquery.rivathemes.js",array(),false,true);
	wp_enqueue_script("owl-carousel", get_template_directory_uri()."/js/owl.carousel.min.js",array(),false,true);    
    wp_enqueue_script("biss-js", get_template_directory_uri()."/js/biss.js",array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'biss_theme_scripts_styles' );

/**** css For Option Header Layout and Footer Layout ****/
function biss_customize_css() {
	global $theme_option;
	if(isset($theme_option['custom-css'])) {
		echo '<style type="text/css">'.$theme_option['custom-css'].'</style>';
	}
}
add_action( 'wp_head', 'biss_customize_css');

/**** Custom Comment Form ****/
function biss_theme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
        <div class="comment-item">
            <div class="wrapper">
                
                <figure><?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=100' ); ?></figure>
                <div class="inner">
                        <p class="name"><?php printf(__('%s','biss'), get_comment_author()) ?></p>
                        <p class="date"><?php printf(get_comment_date('d M, Y'));?></p>                                    
                    <div class="content">
                        <?php if ($comment->comment_approved == '0') { ?>
                        <em><?php _e('Your comment is awaiting moderation.','biss') ?></em>
                        <?php } else {?>
                        <p><?php comment_text() ?></p>
                        <?php } ?>
                    </div>
                <p class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text'=>'<i class="fa fa-reply"></i> reply this', 'max_depth' => $args['max_depth']))) ?></p>
                
                </div>
            </div>    
        </div> 
    
<?php
}

/**** Custom Form Search ****/     
function biss_search_form( $form ) {
    $form = '<form role="search" method="get" class="sidebar-search search" action="' . home_url( '/' ) . '" >  
        <input class="form-control" type="text" value="' . get_search_query() . '" name="s" placeholder="'. __( 'type to search...', 'biss' ) .'" />
        <button type="submit" class="biss-btn biss-btn-primary"><i class="fa fa-search"></i></button>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'biss_search_form' );

/**** Custom Pagination ****/
function biss_pagination($prev = 'Prev', $next = 'Next', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }

    $pagination = array(
        'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
        'format'        => '',
        'current'       => max( 1, get_query_var('paged') ),
        'total'         => $pages,
        'prev_text' => __($prev,'biss'),
        'next_text' => __($next,'biss'),
        'end_size'      => 3,
        'mid_size'      => 3
);
    $return =  paginate_links( $pagination );
    echo str_replace( "<ul class='page-numbers'>", '<ul>', $return );
}

/**** Widget Sidebar ****/
function biss_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'biss' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'biss' ),
		'before_widget' => '<div class="widget %2$s main-content-block">',
		'after_widget'  => '<div class="clearfix"></div></div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) ); 

	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'biss' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'Shop sidebar that appears on the left.', 'biss' ),
		'before_widget' => '<div class="widget biss-shop-widget %2$s main-content-block">',
		'after_widget'  => '<div class="clearfix"></div></div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer One Widget Area', 'biss' ),
		'id'            => 'footer-area-1',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'biss' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2><div class="widget-inner">',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Two Widget Area', 'biss' ),
		'id'            => 'footer-area-2',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'biss' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2><div class="widget-inner">',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Three Widget Area', 'biss' ),
		'id'            => 'footer-area-3',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'biss' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2><div class="widget-inner">',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Fourth Widget Area', 'biss' ),
		'id'            => 'footer-area-4',
		'description'   => __( 'Footer Widget that appears on the Footer.', 'biss' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2><div class="widget-inner">',
	) );           

}
add_action( 'widgets_init', 'biss_widgets_init' );

/**** Custom Breadcrumbs ****/
function biss_breadcrumbs() {

    /* === OPTIONS === */
    $text['home']     = __('Home', 'biss'); // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['tax']      = '%s'; // text for a taxonomy page
    $text['search']   = '%s'; // text for a search results page
    $text['tag']      = '%s'; // text for a tag page
    $text['author']   = '%s'; // text for an author page
    $text['404']      = '404'; // text for the 404 page

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = '<li class="active">'; // tag before the current crumb
    $after       = '</li>'; // tag after the current crumb

    /* === END OF OPTIONS === */

    global $post;
    $homeLink = home_url() . '';
    $linkBefore = '<li>';
    $linkAfter = '</li>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
    } else {
        echo '<ul class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode($cats);
            }

            echo htmlspecialchars_decode($before) . sprintf($text['category'], single_cat_title('', false)) . htmlspecialchars_decode($after);
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode($cats);
            }

            echo htmlspecialchars_decode($before) . sprintf($text['tax'], single_cat_title('', false)) . htmlspecialchars_decode($after);
        }elseif ( is_search() ) {
            echo htmlspecialchars_decode($before) . sprintf($text['search'], get_search_query()) . htmlspecialchars_decode($after);
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo htmlspecialchars_decode($before) . get_the_time('d') . htmlspecialchars_decode($after);
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo htmlspecialchars_decode($before) . get_the_time('F') . htmlspecialchars_decode($after);
        } elseif ( is_year() ) {
            echo htmlspecialchars_decode($before) . get_the_time('Y') . htmlspecialchars_decode($after);
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if ( get_post_type() == 'portfolio' ) {
                	printf($link, $homeLink . '' . $slug['slug'] . '/', 'Portfolio'); //Translate breadcrumb.
            	}else{
            		printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
            	}
                if ($showCurrent == 1) echo htmlspecialchars_decode($delimiter) . htmlspecialchars_decode($before) . get_the_title() . htmlspecialchars_decode($after);
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode($cats);
                if ($showCurrent == 1) echo htmlspecialchars_decode($before) . get_the_title() . htmlspecialchars_decode($after);
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo htmlspecialchars_decode($before) . htmlspecialchars_decode($post_type->labels->singular_name) . htmlspecialchars_decode($after);
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo htmlspecialchars_decode($cats);
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo htmlspecialchars_decode($delimiter) . htmlspecialchars_decode($before) . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo htmlspecialchars_decode($before) . get_the_title() . htmlspecialchars_decode($after);
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo htmlspecialchars_decode($breadcrumbs[$i]);
                if ($i != count($breadcrumbs)-1) echo htmlspecialchars_decode($delimiter);
            }
            if ($showCurrent == 1) echo htmlspecialchars_decode($delimiter) . htmlspecialchars_decode($before) . get_the_title() . htmlspecialchars_decode($after);
        } elseif ( is_tag() ) {
            echo htmlspecialchars_decode($before) . sprintf($text['tag'], single_tag_title('', false)) . htmlspecialchars_decode($after);
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo htmlspecialchars_decode($before) . sprintf($text['author'], $userdata->display_name) . htmlspecialchars_decode($after);
        } elseif ( is_404() ) {
            echo htmlspecialchars_decode($before) . htmlspecialchars_decode($text['404']) . htmlspecialchars_decode($after);
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</ul>';
    }
}   

/**** WP_Title ****/
function biss_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'biss' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'biss_wp_title', 10, 2 );

/**** Excerp Number use: echo biss_excerpt(25); ****/
function biss_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
	  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
      return $excerpt;
}

/**** Register Form ****/
function biss_register_a_user(){
    global $current_user, $wp_roles;
    get_currentuserinfo();
  if(isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = array();
    if(empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['first-name']) || empty($_POST['last-name']) || empty($_POST['pass1'])) $errors[] = 'Please enter a user name and e-mail.';

    $user_login = esc_attr($_POST['user']);
    $user_email = esc_attr($_POST['email']);
    $user_passw  = esc_attr($_POST['pass']);
    $first_name = esc_attr($_POST['first-name']);
    $last_name = esc_attr($_POST['last-name']);
    $pass1 = esc_attr($_POST['pass1']);

    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);
    $user_passw = apply_filters('user_registration_pass', $user_passw);
    $first = sanitize_user($first_name);

    if(!is_email($user_email)) $errors[] = 'Invalid e-mail.';
    elseif(email_exists($user_email)) $errors[] = 'This email is already registered.';

    if(empty($sanitized_user_login) || !validate_username($user_login)) $errors[] = 'Invalid user name.';
    elseif(username_exists($sanitized_user_login)) $errors[] = 'User name already exists.';
    if($pass1 != $user_passw ){$errors[] = 'Invalid re-enter password.Password must be the same';}
    if(empty($errors)):
      $user_pass = $user_passw;
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);var_dump($user_id);
    if ( !empty( $_POST['first-name'] ) ){
    update_user_meta( $user_id, 'first_name', esc_attr( $_POST['first-name'] ) );}
    if ( !empty( $_POST['last-name'] ) ){
    update_user_meta( $user_id, 'last_name', esc_attr( $_POST['last-name'] ) );}
      if(!$user_id):
        $errors[] = 'Registration failed';
      else:
        update_user_option($user_id, 'default_password_nag', true, true);
        wp_new_user_notification($user_id, $user_pass);
      endif;
    endif;

    if(!empty($errors)) define('REGISTRATION_ERROR', serialize($errors));
    else define('REGISTERED_A_USER', $user_email);
  endif;
}
add_action('template_redirect', 'biss_register_a_user');

/**** Add field profile user ****/
add_action( 'show_user_profile', 'biss_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'biss_show_extra_profile_fields' );

function biss_show_extra_profile_fields( $user ) { ?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="job">job</label></th>
            <td>
                <input type="text" name="job" id="job" value="<?php echo esc_attr( get_the_author_meta( 'job', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your Job.</span>
            </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'biss_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'biss_save_extra_profile_fields' );

function biss_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

    /* Copy and paste this line for additional fields. Make sure to change 'job' to the field ID. */
    update_user_meta( $user_id, 'job', $_POST['job'] );
}

/**** Create a query for the custom taxonomy ****/
function related_posts_by_taxonomy( $post_id, $taxonomy, $args=array() ) {
    $query = new WP_Query();
    $terms = wp_get_object_terms( $post_id, $taxonomy );
    // Make sure we have terms from the current post

    if ( count( $terms ) ) {
        $post_ids = get_objects_in_term( $terms[0]->term_id, $taxonomy );
        $post = get_post( $post_id );
        $post_type = get_post_type( $post );
        $type = 'portfolio';
        $args = wp_parse_args( $args, array(
                'post_type' => $type,
                'post__in' => $post_ids,
                'taxonomy' => $taxonomy,
                'term' => $terms[0]->slug,
            ) );
        $query = new WP_Query( $args );
    }
    // Return our results in query form
    return $query;
}

add_action( 'after_setup_theme', 'biss_woocommerce_support' );
function biss_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**** WooCommerce ****/
if (class_exists('Woocommerce')) {
    add_theme_support( 'woocommerce' );
    // Remove each style one by one
    add_filter( 'woocommerce_enqueue_styles', 'biss_dequeue_styles' );
    function biss_dequeue_styles( $enqueue_styles ) {
        unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
        //unset( $enqueue_styles['woocommerce-layout'] );       // Remove the layout
        //unset( $enqueue_styles['woocommerce-smallscreen'] );  // Remove the smallscreen optimisation
        return $enqueue_styles;
    }

    // Or just remove them all in one line
    //add_filter( 'woocommerce_enqueue_styles', '__return_false' );

    // Display 12 products per page. Goes in functions.php
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

    /**
    * woo_custom_product_searchform
    */
    add_filter( 'get_product_search_form' , 'biss_woo_custom_product_searchform' );
    function biss_woo_custom_product_searchform( $form ) {
        $form = '<form role="search" method="get" class="sidebar-search search" action="' . home_url( '/' ) . '" >  
            <input class="form-control" type="text" value="' . get_search_query() . '" name="s" placeholder="'. __( 'type to search...', 'biss' ) .'" />
            <button type="submit" class="biss-btn biss-btn-primary"><i class="fa fa-search"></i></button>            
            <input type="hidden" name="post_type" value="product" />
        </form>';
    return $form;
    }   

    // related products woocommerce
    function woocommerce_output_related_products() {
        woocommerce_related_products(12,3); // Display 4 products in rows of 2
    }
}

/**** Code Visual Compurso. ****/
require_once dirname( __FILE__ ) . '/vc_shortcode.php';
//if(class_exists('WPBakeryVisualComposerSetup')){
function biss_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if($tag=='vc_row' || $tag=='vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', '', $class_string);
    }

    if($tag=='vc_column' || $tag=='vc_column_inner') {
        $class_string = preg_replace('/vc_col-xs-(\d{1,2})/', 'col-xs-$1', $class_string);
        $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string);
        $class_string = preg_replace('/vc_col-md-(\d{1,2})/', 'col-sm-$1', $class_string);
        $class_string = preg_replace('/vc_col-lg-(\d{1,2})/', 'col-lg-$1', $class_string);
    }
    return $class_string;
}

/**** Filter to Replace default css class for vc_row shortcode and vc_column ****/
add_filter('vc_shortcodes_css_class', 'biss_custom_css_classes_for_vc_row_and_vc_column', 10, 2); 

/**** Add new Param in Row ****/
if(function_exists('vc_add_param')){

vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => __('Overlay Style', 'wpb'),
                              "param_name" => "overlay",
                              "value" => array(   
                                                __('None', 'wpb') => 'none',  
                                                __('Dark', 'wpb') => 'dark',  
                                                __('Light', 'wpb') => 'light',                                                                              
                                              ),
                              "description" => __("", "wpb"),   
    ));

vc_add_param('vc_row',array(
                              "type" => "dropdown",
                              "heading" => __('Fullwidth', 'wpb'),
                              "param_name" => "fullwidth",
                              "value" => array(   
                                                __('No', 'wpb') => 'no',  
                                                __('Yes', 'wpb') => 'yes',                                                                                
                                              ),
                              "description" => __("Select Fullwidth or not", "wpb"),      

                            ) 
    );

    

// Add effect param in vc_column_inner 
vc_add_param('vc_column',array(
                              "type" => "textfield",
                              "heading" => __('Container Class', 'wpb'),
                              "param_name" => "wap_class",
                              "value" => "",
                              "description" => __("Container Class", "wpb"),      
                            ) 
    );

vc_add_param('vc_column',array(
                              "type" => "textfield",
                              "heading" => __('Container id', 'wpb'),
                              "param_name" => "wap_id",
                              "value" => "",
                              "description" => __("Container ID", "wpb"),      
                            ) 
    );  


vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "el_id" );
vc_remove_param( "vc_row", "parallax_image" );
vc_remove_param( "vc_row", "parallax" );

}

//}


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.0-alpha
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'biss_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function biss_register_required_plugins() {

    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

       // Plugin Download the http://wordpress.org
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),

         // Plugin Include in Folder Theme
        array(            
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),

        array(
            'name'               => 'LayerSlider WP', // The plugin name.
            'slug'               => 'LayerSlider', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/LayerSlider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),

        array(            
            'name'               => 'OT Portfolio', // The plugin name.
            'slug'               => 'ot_portfolio', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot_portfolio.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 
        array(            
            'name'               => 'OT Team', // The plugin name.
            'slug'               => 'ot_team', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot_team.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 
        array(            
            'name'               => 'OT Testimonial', // The plugin name.
            'slug'               => 'ot_testimonial', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot_testimonial.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 
        array(            
            'name'               => 'OT Service', // The plugin name.
            'slug'               => 'ot_service', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot_service.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 

        array(            
            'name'               => 'OT Events', // The plugin name.
            'slug'               => 'ot_events', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot_events.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 

         array(            
            'name'               => 'OT FAQs', // The plugin name.
            'slug'               => 'ot_faqs', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/ot_faqs.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ), 

        array(
            'name'                     => 'Woocommerce', // The plugin name
            'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
            'required'                 => false, // If false, the plugin is only 'recommended' instead of required
        ),

        array(
            'name'                     => 'Contact Form 7', // The plugin name
            'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'                 => false, // If false, the plugin is only 'recommended' instead of required
        ),      

        array(
            'name'                     => 'Newsletter', // The plugin name
            'slug'                     => 'newsletter', // The plugin slug (typically the folder name)
            'required'                 => false, // If false, the plugin is only 'recommended' instead of required
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are wrapped in a sprintf(), so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'biss' ),
            'menu_title'                      => __( 'Install Plugins', 'biss' ),
            'installing'                      => __( 'Installing Plugin: %s', 'biss' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'biss' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %s plugin.',
                'Sorry, but you do not have the correct permissions to install the %s plugins.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %s plugins.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'biss'
            ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %s plugin.',
                'Sorry, but you do not have the correct permissions to update the %s plugins.',
                'biss'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'biss'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'biss'
            ),
            'return'                          => __( 'Return to Required Plugins Installer', 'biss' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'biss' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'biss' ), // %s = dashboard link.
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

            'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

