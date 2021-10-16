<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;

/**
 * Sets the active theme on front page.
 */
class DrupalHacksThemeNegotiator implements ThemeNegotiatorInterface {

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) : bool {
    return FALSE;
    $routeName = $route_match->getRouteName();
    return ($routeName == 'view.frontpage.page_1') ? TRUE : FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) : string {
    return 'seven';
  }

}
