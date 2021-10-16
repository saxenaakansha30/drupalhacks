<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\drupalhacks\MusicalInstrumentsInterface;

/**
 * Defines the MusicalInstruments entity.
 *
 * @ConfigEntityType(
 *   id = "musical_instruments",
 *   label = @Translation("Musical Instruments"),
 *   handlers = {
 *     "list_builder" = "Drupal\drupalhacks\Controller\MusicalInstrumentsListBuilder",
 *     "form" = {
 *       "add" = "Drupal\drupalhacks\Form\MusicalInstrumentsForm",
 *       "edit" = "Drupal\drupalhacks\Form\MusicalInstrumentsForm",
 *       "delete" = "Drupal\drupalhacks\Form\MusicalInstrumentsDeleteForm",
 *     }
 *   },
 *   config_prefix = "musical_instruments",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "name" = "name",
 *     "type" = "type",
 *   },
 *   config_export = {
 *     "id",
 *     "name",
 *     "type",
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/drupalhacks/{musical_instruments}",
 *     "delete-form" = "/admin/config/system/drupalhacks/{musical_instruments}/delete",
 *   }
 * )
 */
class MusicalInstruments extends ConfigEntityBase implements MusicalInstrumentsInterface {

  /**
   * The MusicalInstruments ID.
   *
   * @var id
   */
  protected $id;

  /**
   * The MusicalInstruments name.
   *
   * @var string
   */
  protected $name;

  /**
   * The MusicalInstruments type.
   *
   * @var string
   */
  protected $type;

  /**
   * {@inheritdoc}
   */
  public function getId() : string {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function getName() : ?string {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function getType() : ?string {
    return $this->type;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) : void {
    $this->name = $name;
  }

  /**
   * {@inheritdoc}
   */
  public function setType($type) : void {
    $this->name = $type;
  }

}
