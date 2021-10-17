<?php

namespace Drupal\drupalhacks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use \Drupal\Core\Security\TrustedCallbackInterface;

/**
 * Block to demonstrate lazyloading in Drupal.
 *
 * @Block(
 *   id = "drupalhacks_lazyloading",
 *   admin_label = @Translation("Drupalhacks Lazy Loading Example Block"),
 * )
 */
class LazyLoadingExampleBlock extends BlockBase implements TrustedCallbackInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['normal'] = [
      '#markup' => $this->t('I am not expensive data.'),
    ];

    $build['complex'] = [
      '#lazy_builder' => [static::class . '::lazyBuildComplexData', []],
      '#create_placeholder' => TRUE,
    ];

    // $build['complex'] = self::lazyBuildComplexData();

    return $build;
  }

  /**
   * Callback for creating render array for complex data.
   */
  public static function lazyBuildComplexData() {
    // sleep(15); // Uncomment this to add delay to page load.
    return [
      '#markup' => 'I am expensive data to load. I take time to load.',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function trustedCallbacks() {
    return ['lazyBuildComplexData'];
  }

}
