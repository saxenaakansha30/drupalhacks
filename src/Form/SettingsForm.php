<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\drupalhacks\Utility;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\State\State;

/**
 * Defines a form that configures forms drualhacks settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * @var Drupalhacks Utility service.
   */
  protected $utility;

  /**
   * @var State api object.
   */
  protected $state;

  /**
   * Class constructor.
   */
  public function __construct(Utility $utility, State $state) {
    $this->utility = $utility;
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('drupalhacks.utility'),
      $container->get('state'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalhacks_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'drupalhacks.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('drupalhacks.settings');
    $form['message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Generic Message'),
      '#default_value' => $config->get('message'),
    ];

    $form['site_specific_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site Specific Message'),
      '#default_value' => $this->state->get('drupalhacks.site_specific_msg'),
    ];

    $form['delete_state_data'] = [
      '#type' => 'submit',
      '#value' => $this->t('Delete Site Specific Message'),
      '#submit' => [
        [$this, 'deletStateDate'],
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('drupalhacks.settings')
      ->set('message', $form_state->getValue('message'))
      ->save();
    parent::submitForm($form, $form_state);

    // Store the Site specific Drupalhacks state message using state api.
    $this->state->set('drupalhacks.site_specific_msg', $form_state->getValue('site_specific_msg'));
  }

  /**
   * Delete State data of this class.
   */
  public function deletStateDate(array &$form, FormStateInterface $form_state) {
    // Delet the Site specific Drupalhacks state message using state api.
    $this->state->delete('drupalhacks.site_specific_msg');
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if($this->utility->hasSpecialCharacters($form_state->getValue('message'))) {
      $form_state->setErrorByName('message', $this->t('Special Characters are not allowed.'));
    }
  }

}
