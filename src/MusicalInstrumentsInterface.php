<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for MusicalInstruments Configurable Entity.
 */
interface MusicalInstrumentsInterface extends ConfigEntityInterface {

  /**
   * Returns the unique id of the entity.
   */
  public function getId() : string;

  /**
   * Returns the name of the instrument.
   */
  public function getName() : ?string;

  /**
   * Set name of the instrument.
   *
   * @param string $name
   *   Name to set.
   */
  public function setName($name) : void;

  /**
   * Returns the type of the instrument.
   */
  public function getType() : ?string;

  /**
   * Set type of the instrument.
   *
   * @param string $type
   *   Type to set.
   */
  public function setType($type) : void;

}
