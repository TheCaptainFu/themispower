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
      '#cache' => [
        'max-age' => 0, // Disable caching for home page
        'contexts' => ['user.roles'], // Cache varies by user role (anonymous vs authenticated)
      ],
    ];

    return $build;
  }

}

