<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\drupalhacks\HumanManager;

/**
 * Provides page to show Human type services.
 */
class RenderHumanPlugins extends ControllerBase {

  /**
   * Object of Human Plugin Manager.

   * @var object
   */
  protected $humanPluginManager;

  /**
   * Class constructor.
   */
  public function __construct(HumanManager $humanPluginManager) {
    $this->humanPluginManager = $humanPluginManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.human')
    );
  }

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function renderHumans() {
    $pluginDefinitions = $this->humanPluginManager->getDefinitions();

    $header = [
      'id' => t('IDentification Number'),
      'name' => t('Name'),
      'gender' => t('Gender'),
      'nationality' => t('Nationality'),
      'dob' => t('DOB'),
    ];
    foreach ($pluginDefinitions as $key => $row) {
      $rows[] = [
        $row['id'],
        $row['name'],
        $row['gender'],
        $row['nationality'],
        $row['dob'],
      ];
    }
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}
