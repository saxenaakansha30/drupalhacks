<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form handler for the MusicalInstruments add and edit forms.
 */
class MusicalInstrumentsForm extends EntityForm {

  /**
   * Constructs an MusicalInstrumentsForm object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entityTypeManager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $entity = $this->entity;

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 255,
      '#default_value' => $entity->getName(),
      '#description' => $this->t("Name for the Musical Instrument."),
      '#required' => TRUE,
    ];
    $form['type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type'),
      '#maxlength' => 255,
      '#default_value' => $entity->getType(),
      '#description' => $this->t("Type of the Musical Instrument."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $entity->id(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
      '#disabled' => !$entity->isNew(),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = $entity->save();

    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage($this->t('The %name Musical Instrument created.', [
        '%name' => $entity->getName(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %name Musical Instrument updated.', [
        '%name' => $entity->getName(),
      ]));
    }

    $form_state->setRedirect('entity.musical_instruments.collection');
  }

  /**
   * Helper function to check whether an Example configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityTypeManager->getStorage('musical_instruments')->getQuery()
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }

}
