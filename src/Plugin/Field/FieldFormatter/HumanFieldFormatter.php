<?php

namespace Drupal\drupalhacks\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\drupalhacks\HumanManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the Human formatter.
 *
 * @FieldFormatter(
 *   id = "human_formatter",
 *   label = @Translation("Human"),
 *   field_types = {
 *     "human",
 *   }
 * )
 */
class HumanFieldFormatter extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * Object of Human Plugin Manager.

   * @var object
   */

  protected $humanPluginManager;

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, HumanManager $humanPluginManager) {
    parent::__construct($plugin_id, $plugin_id, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->humanPluginManager = $humanPluginManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.human')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays selected human info');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $rows = [];
    $header = [
      'id' => t('IDentification Number'),
      'name' => t('Name'),
      'gender' => t('Gender'),
      'nationality' => t('Nationality'),
      'dob' => t('DOB'),
    ];
    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $humanInfo = $this->humanPluginManager->getDefinition($item->value);
      $rows[] = [
        $humanInfo['id'],
        $humanInfo['name'],
        $humanInfo['gender'],
        $humanInfo['nationality'],
        $humanInfo['dob'],
      ];
    }
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}
