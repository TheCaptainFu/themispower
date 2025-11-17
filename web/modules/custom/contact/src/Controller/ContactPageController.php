<?php

namespace Drupal\contact\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for contact page.
 */
class ContactPageController extends ControllerBase {

  /**
   * Returns content for the contact page.
   */
  public function content() {
    return [
      '#theme' => 'contact_page',
      '#email' => 'themispower@gmail.com',
      '#phone' => '6986719272',
      '#address' => '123 Main Street, City, State 12345',
      '#hours' => [
        'weekday' => 'Monday - Friday: 9:00 AM - 5:00 PM',
        'weekend' => 'Saturday - Sunday: Closed',
      ],
    ];
  }

}