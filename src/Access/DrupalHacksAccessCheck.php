<?php

namespace Drupal\drupalhacks\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Defines access check for Drupalhacks.
 */
class DrupalHacksAccessCheck implements AccessInterface {

  /**
   * A custom access check.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Run access checks for this account.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(AccountInterface $account) {
    // Check permissions and combine that with any custom access checking needed. Pass forward

    return AccessResult::allowed();
    // parameters from the route and/or request as needed.
    return $account->hasPermission('view contact entity') ? AccessResult::allowed() : AccessResult::forbidden();
  }

}
