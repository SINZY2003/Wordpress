<?php

add_Action('rest_api_init', 'register_search_route');
function register_search_route() {
    register_rest_route('post', 'authornNme', array(
        'get_call_back'=> function(){return get_the_authour();}
    ));
}

function pageBanner(array $args=NULL) {
    if (!isset($args['title'])) {
        $args['title'] = get_the_title();
    }
    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if (!isset($args['photo'])) {
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  
    ?>
    <div class="page-banner">
<div class="page-banner__bg-image" style="background-image: url(<?php 
echo get_field('page_banner_background_image')['sizes']['pageBanner']; 
?>);"></div>
<div class="page-banner__content container container--narrow">
  <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
  <div class="page-banner__intro">
    <p><?php echo $args['subtitle']; ?></p>
  </div>
</div>  
</div>
 <?php
 }
function Fictional_University_files() {
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('Font-Awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('Fictional_University_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('Fictional_University_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
    
}
add_action('wp_enqueue_scripts', 'Fictional_University_files');


function University_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 1500, 350, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'University_features');
add_action('pre_get_posts', 'University_adjust_queries');
function universityMapKey($api) {
    $api['key'] = 'AIzaSyBh9b1rNCp6k0i5JeMHiRP4klDymBeoEWk';
    return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');
function University_adjust_queries($query) {
    if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_key', 'event_date');
        $query->set('meta_query', array(
            array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => date('Ymd'),
            'type' => 'numeric'
          )));
    }
}
