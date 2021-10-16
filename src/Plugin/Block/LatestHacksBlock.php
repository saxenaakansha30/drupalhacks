<?php

declare(strict_types=1);

namespace Drupal\drupalhacks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides block for showing latest hacks of drupalhacks.
 *
 * @Block(
 *   id = "drupalhacks_latest_hacks",
 *   admin_label = @Translation("Drupalhacks Latest Hacks"),
 * )
 */
class LatestHacksBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Construct LatestHacksBlock instance.
   *
   * @param array $configuration
   *   Plugin Configuration.
   * @param string $plugin_id
   *   Plugin id.
   * @param mixed $plugin_definition
   *   Plugin definition.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ModuleHandlerInterface $module_handler) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->moduleHandler = $module_handler;
  }

  /**
   * Inject Depenencies needed by LatestHacksBlock.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   Service container.
   * @param array $configuration
   *   Plugin Configuration.
   * @param string $plugin_id
   *   Plugin id.
   * @param mixed $plugin_definition
   *   Plugin definition.
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('module_handler')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $hacks_tid = 3;
    $query = \Drupal::entityQuery('node')
      ->condition('field_tags', $hacks_tid)
      ->sort('created', 'DESC')
      ->range(0, 5);
    $list = $query->execute();

    $this->moduleHandler->invokeAll('drupalhacks_latest_hacks', [$list]);
    $this->moduleHandler->alter('drupalhacks_latest_hacks', $list);

    $list_to_string = implode(", ", $list);

    return [
      // '#plain_text' => '<marquee>Latest Hacks: ' . $list_to_string . '</marquee>',
      '#markup' => '<marquee>Latest Hacks: ' . $list_to_string . '</marquee>',
      '#allowed_tags' => ['marquee'],
      'children' => [
        '#plain_text' => '<marquee>Latest Hacks: ' . $list_to_string . '</marquee>',
      ]
    ];

  }

}
