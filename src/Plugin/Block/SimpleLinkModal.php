<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Drupalhacks Block to open node data in modal.
 *
 * @Block(
 *   id = "simple_link_modal",
 *   admin_label = @Translation("Drupal Hacks Simple Link Modal"),
 *   category = @Translation("Drupal Hacks Simple Link Modal"),
 * )
 */
class SimpleLinkModal extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
  $variables['#attached']['library'][] = 'drupalhacks/global';
    return [
      '#theme' => 'node_modal',
      '#nid' => 2,
      '#attached' => [
        'library' => ['drupalhacks/global']
      ]
    ];
  }

}
