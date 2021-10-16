<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Block to explain Cache API exapmles.
 *
 * @Block(
 *   id = "drupalhacks_cache_api",
 *   admin_label = @Translation("Druplhacks Cache API Example Block"),
 * )
 */
class CacheExampleBlock extends BlockBase {

  public function build($value='')
  {
    $output = '</p>Some random string: ' . rand(1,1000) . '</p>';

    return [
      '#markup' => $output,
      '#cache' => [
        'tags' => [
          'node_list', // Invalidating.
        ],
        'contexts' => [
          'url',
        ],
        'max-age' => 10,
      ],
    ];
  }

}
