<?php
get_header();
pageBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => 'We have campuses in every continent',
  'photo' => get_theme_file_uri('/images/ocean.jpg')
));
?>
<div class="container container--narrow page-section">
  <ul class="link-list min-list">
  <?php
  while (have_posts()) {
    the_post(); ?>
   <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
   <?php the_content();?>
    <?php }?>
  </ul>
</div>
<?php get_footer();
?>