<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Human annotation object.
 *
 * Plugin namespace: Plugin\Human
 *
 * @see \Drupal\drupalhacks\HumanManager
 *
 * @Annotation
 */
class HumanData extends Plugin {

  /**
   * The plugin ID.
   *
   * @var int
   */
  public $id;

  /**
   *  Name of human.
   */
  public $name;

  /**
   * Gender of human.
   *
   * @var string
   */
  public $gender;

  /**
   * Nationality of the human.
   *
   * @var string
   */
  public $nationality;

  /**
   * Date of the time of human born.
   * @var string
   */
  public $dob;

}
