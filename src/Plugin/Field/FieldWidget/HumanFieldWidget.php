<?php

namespace Drupal\drupalhacks\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\drupalhacks\HumanManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Field\FieldDefinitionInterface;

/**
 * Widget for Human field type..
 *
 * @FieldWidget(
 *   id = "human_widget",
 *   label = @Translation("Human widget"),
 *   field_types = {
 *     "human",
 *   }
 * )
 */
class HumanFieldWidget extends WidgetBase implements ContainerFactoryPluginInterface {

  /**
   * Object of Human Plugin Manager.
   *
   * @var object
   */
  protected $humanPluginManager;

  /**
   * Class constructor.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, HumanManager $humanPluginManager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
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
      $configuration['third_party_settings'],
      $container->get('plugin.manager.human')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    // Build Options.
    $pluginDefinitions = $this->humanPluginManager->getDefinitions();

    $options = [];
    foreach ($pluginDefinitions as $key => $row) {
      $options[$row['id']] = $row['name'];
    }

    $element += [
      '#type' => 'select',
      '#title' => $this->t('Select Human'),
      '#options' => $options,
    ];
    return ['value' => $element];
  }

}
