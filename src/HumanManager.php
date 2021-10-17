<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks;

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Provides an Human plugin manager.
 */
class HumanManager extends DefaultPluginManager {

  /**
   * Constructs a ArchiverManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Human', // Sub directory of the plugins.
      $namespaces,
      $module_handler,
      'Drupal\drupalhacks\HumanInterface', // Plugin interface for blueprint, optional
      'Drupal\drupalhacks\Annotation\HumanData' //  Annotation discovery class, optional
    );
    $this->alterInfo('human_info');
    $this->setCacheBackend($cache_backend, 'human_info_plugins');
  }

}
