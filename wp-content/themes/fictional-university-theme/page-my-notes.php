<?php
if(!is_user_logged_in()) {
    wp_redirect(site_url('/'));
    exit;
}

get_header();

while (have_posts()) {
    the_post(); 
    pageBanner(array(
      'title' => get_the_title(),
      'subtitle' => get_field('page_banner_subtitle'),
    ));
    ?>

<div class="container container--narrow page-section">
  Custome

</div>
    <?php
}
get_footer();
?>