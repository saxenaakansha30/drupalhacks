<?php

/**
 * @file
 * Config form to practice for certification.
 */

namespace Drupal\drupalhacks\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenOffCanvasDialogCommand;

/**
 * Class containing config form to practice Form API.
 */
class CertificationConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupalhacks.cert_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return 'drupalhacks_cert_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['no_1'] = [
      '#title' => $this->t('Number 1'),
      '#type' => 'textfield',
      '#ajax' => [
        'callback' => [$this, 'calSum'],
        'event' => 'keyup',
      ],
    ];

    $form['no_2'] = [
      '#title' => $this->t('Number 2 '),
      '#type' => 'textfield',
      '#ajax' => [
        'callback' => [$this, 'calSum'],
        'event' => 'keyup',
      ],
    ];

    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $form['#attached']['library'][] = 'drupalhacks/global';
    $form['#attached']['drupalSettings']['abc'] = 'variable_value';

    return $form;
    // return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function calSum(array &$form, FormStateInterface $form_state) {
    $no1 = $form_state->getValue('no_1');
    $no2 = $form_state->getValue('no_2');
    $output = $no1 + $no2;
    $output = $this->t('Sum of number 1 and number 2 is: @out', [
      '@out' => $output,
    ]);

    $dialog_options= ['minHeight'=>200,'resizable'=>true];
    $position='{ my: "left top", at: "left bottom", of: button }';
    $response = new AjaxResponse();
    $response->addCommand(new OpenOffCanvasDialogCommand("Sum (Dialog Box Heading)", $output, $dialog_options,[], $position));
    return $response;
  }

}
