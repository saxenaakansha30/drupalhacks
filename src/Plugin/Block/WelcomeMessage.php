<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Drupalhacks 'Welcome' Block.
 *
 * @Block(
 *   id = "welcome_block",
 *   admin_label = @Translation("Drupal Hacks Welcome Message"),
 *   category = @Translation("Drupal Hacks Welcome Message"),
 * )
 */
class WelcomeMessage extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   *  The config factory object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $configFactory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $configFactory;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $drupalHacksConfig =  $this->getSettings();
    return [
      '#markup' => $drupalHacksConfig->get('message'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['to_whom'] = [
      '#type' => 'textfield',
      '#title' => $this->t('To Whom'),
      '#description' => $this->t('Who do you want to represent this message to: %name and site :site', ['%name' => 'Akansha', ':site' => 'http://www.akansha_saxena.com']),
      '#default_value' => $config['to_whom'] ?? '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['to_whom'] = $values['to_whom'];
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    if($form_state->getValue('to_whom') === 'John'){
      $form_state->setErrorByName('hello_block_name', $this->t('You can not say hello to John.'));
    }
  }

  /**
   * Get DrupalHacks Settings.
   */
  public function getSettings() {
   return $this->configFactory->get('drupalhacks.settings');
  }

}
