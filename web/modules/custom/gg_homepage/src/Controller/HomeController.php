<?php

namespace Drupal\gg_homepage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Returns responses for GG Homepage routes.
 */
class HomeController extends ControllerBase {

  /**
   * Returns the homepage content.
   */
  public function render(Request $request) {
    return [];
  }

}

