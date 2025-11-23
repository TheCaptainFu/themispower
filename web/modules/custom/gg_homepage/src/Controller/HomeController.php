<?php

namespace Drupal\gg_homepage\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for GG Homepage routes.
 */
class HomeController extends ControllerBase {

  /**
   * Builds the home page content.
   *
   * @return array
   *   A render array containing the home page content.
   */
  public function content() {
    // Get current user information.
    $current_user = \Drupal::currentUser();
    $is_logged_in = $current_user->isAuthenticated();
    
    $build = [
      '#theme' => 'gg_homepage',
      '#logged_in' => $is_logged_in,
      '#current_user' => [
        'name' => $current_user->getAccountName(),
        'id' => $current_user->id(),
      ],
      '#attached' => [
        'http_header' => [
          ['Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0'],
          ['Pragma', 'no-cache'],
          ['Expires', '0'],
          ['X-LiteSpeed-Cache-Control', 'no-cache'],
        ],
      ],
    ];
    
    return $build;
  }

}

