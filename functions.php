<?php
add_action('after_setup_theme', 'ds_add_theme_supports');
function ds_add_theme_supports() {
    add_theme_support('post-thumbnails');
}

add_action('wp_enqueue_scripts', 'ds_enqueue_styles');
function ds_enqueue_styles() {
    wp_enqueue_style('ds-info', get_stylesheet_directory_uri() . '/style.css', [], filemtime(get_stylesheet_directory() . '/style.css'), 'all');

    if(!is_admin()) {
        wp_enqueue_style('ds-font', 'https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@300;400;500;600;700;800;900&display=swap');
        wp_enqueue_style('ds-main', get_stylesheet_directory_uri() . '/src/css/main.css', [], filemtime(get_stylesheet_directory() . '/src/css/main.css'));

        $is_contact = is_page(19);
        $is_about = is_page(2);

        if(is_front_page()) {
            wp_enqueue_style('ds-homepage', get_stylesheet_directory_uri() . '/src/css/homepage.css', [], filemtime(get_stylesheet_directory() . '/src/css/homepage.css'));
        }

        if(is_single() || $is_about || $is_contact) {
            wp_enqueue_style('ds-single', get_stylesheet_directory_uri() . '/src/css/single.css', [], filemtime(get_stylesheet_directory() . '/src/css/single.css'));
        }

        if($is_contact) {
            wp_enqueue_style('ds-contact', get_stylesheet_directory_uri() . '/src/css/contact.css', [], filemtime(get_stylesheet_directory() . '/src/css/contact.css'));
        }

        if($is_about) {
            wp_enqueue_style('ds-about', get_stylesheet_directory_uri() . '/src/css/about.css', [], filemtime(get_stylesheet_directory() . '/src/css/about.css'));
        }
    }

}

add_action('wp_enqueue_scripts', 'ds_enqueue_scripts');
function ds_enqueue_scripts() {
    if(!is_admin()) {
        wp_enqueue_script('main', get_stylesheet_directory_uri() . '/src/js/main.js', [], filemtime(get_stylesheet_directory() . '/src/js/main.js'), true);
    }
}

add_action('init', 'ds_set_pagination_base');
function ds_set_pagination_base() {
    global $wp_rewrite;

    $wp_rewrite->pagination_base = 'strona';
}

add_action( 'login_enqueue_scripts', 'ds_login_logo' );
function ds_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo ds_logo_url(); ?>);
		    height: 57px;
		    width: 87px;
            background-size: cover;
            border-radius: 0.3rem;
        }
    </style>
<?php }

add_filter( 'query_vars', 'ds_query_vars' );
function ds_query_vars( $qvars ) {
	$qvars[] = 'fraza';
	return $qvars;
}

add_filter( 'login_headerurl', 'ds_login_logo_url' );
function ds_login_logo_url() {
    return home_url();
}

function ds_inline_svg(string $filename)
{
    if (file_exists(get_stylesheet_directory() . '/src/assets/svg/' . $filename . '.svg')) {
        return file_get_contents(get_stylesheet_directory_uri() . '/src/assets/svg/' . $filename . '.svg');
    }
    return '';
}

function ds_logo_url()
{
    if (file_exists(get_stylesheet_directory() . '/src/assets/img/logo.png')) {
        return get_template_directory_uri() . '/src/assets/img/logo.png';
    }
    return '';
}


function ds_get_time_ago() {
    global $post;
    if($post) {
        return sprintf( esc_html__( '%s temu', 'textdomain' ), human_time_diff(get_the_time ( 'U' ), current_time( 'timestamp' ) ) );
    } else {
        return "";
    }
}

function ds_get_post_tags($post_id) {
    $tags_arr = wp_get_post_tags($post_id, array('fields' => 'all'));
    $tags     = "";

    if( isset($tags_arr[0] )) {
        foreach($tags_arr as $tag) {
            $tags .= '<a href="' . home_url() . "/tag/" . $tag->slug .'">#' . $tag->name . '</a>';
        }
    } 

    return $tags;
}

function ds_get_post_categories($post_id) {
    $cats_arr = wp_get_post_categories($post_id, array('fields' => 'all'));
    $cats     = "";

    
    if( isset($cats_arr[0] )) {
        foreach($cats_arr as $cat) {
            $cats .= '<a href="' . home_url() . "/kategoria/" . $cat->slug .'">' . $cat->name . '</a>';
        }
    } 

    return $cats;
}

function ds_get_caption($attachment_id) {
    if($attachment_id) {
        $attachment_author = get_field('attachment_author', $attachment_id);
        $attachment_url    = get_field('attachment_url', $attachment_id);
        $license           = get_field('license', $attachment_id);
        $license_url       = get_field('license_url', $attachment_id);
        $caption_front     = "";
        $caption_end       = "";
        $caption           = "";

        if($attachment_author) {
            if($attachment_url) {
                $caption_front = "<a href='" . $attachment_url . "' target='__blank'>" . $attachment_author . "</a>";
            } else {
                $caption_front = "<span>" . $attachment_author . "</span>";
            }

            if($license) {
                if($license_url) {
                    $caption_end = "<a href='" . $license_url . "' target='__blank'>" . $license . "</a>";
                } else {
                    $caption_end = "<span>" . $license . "</span>";
                }
            }
        }

        if($caption_front) {
            $caption = $caption_front;

            if($caption_end) {
                $caption = $caption_front . " / " . $caption_end;
            }
        }
    } 

    return $caption;
}

function ds_get_view() {
    $view = 'grid';
    
    if(isset($_COOKIE["ds-view"]) && in_array($_COOKIE["ds-view"], array('grid','list'))) {
        $view = $_COOKIE["ds-view"];
    }

    return $view;
}

function ds_log($log)
{
    if (true === WP_DEBUG) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

function my_wpdiscuz_shortcode() {
    $html = "";
    if (file_exists(ABSPATH . "wp-content/plugins/wpdiscuz/themes/default/comment-form.php")) {
        ob_start();
        include ABSPATH . "wp-content/plugins/wpdiscuz/themes/default/comment-form.php";
        $html = ob_get_clean();
    }
    return $html;
}
add_shortcode("wpdiscuz_comments", "my_wpdiscuz_shortcode");
?>