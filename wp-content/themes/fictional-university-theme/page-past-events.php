<?php
get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A Recap Of our Pasts Events'
));
?>

<div class="container container--narrow page-section">
  <?php
  $pastEvents= new WP_Query(array(
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    //'posts_per_page' => 1,//
    'meta_key' => 'event_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '<=',
        'value' => date('Ymd'),
        'type' => 'numeric'
      )
    )
  ));
  while ($pastEvents->have_posts()) {
    $pastEvents->the_post(); 
    get_template_part('template-parts/content-event');}
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'format' => '?paged=%#%',
        'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
    )); ?>
</div>
<?php get_footer();
?>