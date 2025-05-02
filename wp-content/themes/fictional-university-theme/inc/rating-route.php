<?php
add_action('rest_api_init', function () {
  register_rest_route('university/v1', 'manageRating', [
    'methods' => ['POST', 'DELETE'],
    'callback' => 'universityHandleRating',
    'permission_callback' => function () {
      return is_user_logged_in();
    }
  ]);
});

function universityHandleRating(WP_REST_Request $request) {
  $params = json_decode(file_get_contents('php://input'), true);
  $method = $_SERVER['REQUEST_METHOD'];
  $currentUser = get_current_user_id();

  if ($method === 'POST') {
    $professorId = sanitize_text_field($params['professorId'] ?? '');
    $rating = intval($params['rating'] ?? 0);

    if (!$professorId || !$rating) {
      return new WP_REST_Response('Missing professorId or rating', 400);
    }

    $existingRating = new WP_Query([
      'post_type' => 'rating',
      'author' => $currentUser,
      'meta_query' => [
        [
          'key' => 'professor_id',
          'value' => $professorId,
          'compare' => '='
        ]
      ]
    ]);

    if ($existingRating->found_posts) {
      $postId = $existingRating->posts[0]->ID;
      wp_update_post([
        'ID' => $postId,
        'meta_input' => [
          'rating' => $rating
        ]
      ]);
      return new WP_REST_Response($postId, 200);
    } else {
      $newPostId = wp_insert_post([
        'post_type' => 'rating',
        'post_status' => 'publish',
        'post_title' => 'Professor Rating',
        'meta_input' => [
          'professor_id' => $professorId,
          'rating' => $rating
        ],
        'post_author' => $currentUser
      ]);
      return new WP_REST_Response($newPostId, 201);
    }
  }

  if ($method === 'DELETE') {
    $ratingId = intval($params['ratingId'] ?? 0);

    if (!$ratingId || get_post_type($ratingId) !== 'rating' || get_post_field('post_author', $ratingId) != $currentUser) {
      return new WP_REST_Response('Invalid rating ID', 403);
    }

    wp_delete_post($ratingId, true);
    return new WP_REST_Response('Rating deleted', 200);
  }

  return new WP_REST_Response('Unsupported method', 405);
}
