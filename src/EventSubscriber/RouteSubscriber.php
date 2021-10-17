<?php

namespace Drupal\drupalhacks\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use \Symfony\Component\Routing\RouteCollection;

/**
 * Service to alter routes.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {

    if ($route = $collection->get('entity.user.edit_form')) {
      $route->setRequirement('_permission', 'access user edit page');
    }
  }

}
