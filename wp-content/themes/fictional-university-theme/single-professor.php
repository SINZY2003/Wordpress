<?php
  
  get_header();

  while(have_posts()) {
    the_post();
    pageBanner();
     ?>
    

    <div class="container container--narrow page-section">
          
      <div class="generic-content">
        <div class="row group">

          <div class="one-third">
            <?php the_post_thumbnail('professorPortrait'); ?>
          </div>

          <div class="two-thirds">
            <?php

              $likeCount = new WP_Query(array(
                'post_type' => 'like',
                'meta_query' => array(
                  array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => get_the_ID()
                  )
                )
              ));

              $existStatus = 'no';

              if (is_user_logged_in()) {
                $existQuery = new WP_Query(array(
                  'author' => get_current_user_id(),
                  'post_type' => 'like',
                  'meta_query' => array(
                    array(
                      'key' => 'liked_professor_id',
                      'compare' => '=',
                      'value' => get_the_ID()
                    )
                  )
                ));

                if ($existQuery->found_posts) {
                  $existStatus = 'yes';
                }
              }

              $userRatingQuery = new WP_Query(array(
                'post_type' => 'rating',
                'author' => get_current_user_id(),
                'meta_query' => array(
                  array(
                    'key' => 'professor_id', // Changed from 'rated_professor_id'
                    'value' => get_the_ID(),
                    'compare' => '='
                  )
                )
              ));
              
              $userRating = $userRatingQuery->found_posts ? get_post_meta($userRatingQuery->posts[0]->ID, 'rating', true) : 0; // Changed from 'star_rating'
              $ratingId = $userRatingQuery->found_posts ? $userRatingQuery->posts[0]->ID : '';
            ?>

            <span class="like-box" data-like="<?php echo (isset($existQuery) && $existQuery->found_posts ? $existQuery->posts[0]->ID : ''); ?>" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
              <i class="fa fa-heart-o" aria-hidden="true"></i>
              <i class="fa fa-heart" aria-hidden="true"></i>
              <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
            </span>
            <?php the_content(); ?>
            <div class="star-rating-box" data-rating-id="<?php echo esc_attr($ratingId); ?>" data-professor="<?php the_ID(); ?>" data-current-rating="<?php echo esc_attr($userRating); ?>">
              <h2>Ratings</h2>
              <?php for ($i = 1; $i <= 5; $i++): ?>
              <i class="fa fa-star<?php echo ($i <= $userRating) ? '' : '-o'; ?>" data-star="<?php echo $i; ?>"></i>
             <?php endfor; ?>
             </div>
          </div>
        </div>
      </div>

      <?php

        $relatedPrograms = get_field('related_programs');

        if ($relatedPrograms) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
          echo '<ul class="link-list min-list">';
          foreach($relatedPrograms as $program) { ?>
            <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
          <?php }
          echo '</ul>';
        }

      ?>

    </div>
    
  <?php }

  get_footer();

?>