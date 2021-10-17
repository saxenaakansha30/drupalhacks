<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Controller;

use Drupal\drupalhacks\Entity\Contact;

/**
 * Provides route responses for the Drupalhacks module.
 */
class CustomParamConverterController {

  /**
   * Returns a content.
   *
   * @return array
   *   A simple renderable array.
   */
  public function content(Contact $contact_entity) {
    if ($contact_entity instanceof \Drupal\drupalhacks\ContactInterface) {
      $build = [
        '#markup' => 'Hello, from ' . $contact_entity->label(),
      ];
      return $build;
    }
  }

}
