<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides route responses for the module.
 */
class HomePageController {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function homePage() {
    return [
      '#markup' => 'Hello, world',
    ];
  }

  /**
   * Checks access for the current account.
   */
  public function access(AccountInterface $account) {
    // Check permissions and combine that with any custom access checking needed. Pass forward
    // parameters from the route and/or request as needed.
    return AccessResult::allowedIf(
      $account->hasPermission('view contact entity'));
  }

}
