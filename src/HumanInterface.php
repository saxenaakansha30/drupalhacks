<?php
/**
 * @file
 * Provides Drupal\drupalhacks\HumanInterface
 */

declare(strict_types = 1);

namespace Drupal\drupalhacks;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for human types plugins.
 */
interface HumanInterface extends PluginInspectionInterface {

  /**
   * Return the unique identification number of the human.
   *
   * @return int
   */
  public function getId();

  /**
   * Return the nationality of the human.
   *
   * @return string
   */
  public function getNationality();

  /**
   * Return the gender of the Human.
   *
   * @return string
   */
  public function getGender();

  /**
   * Return the dob of the human.
   *
   * @return string
   */
  public function getDob();

  /**
   * Return the name of the human.
   *
   * @return string
   */
  public function getName();

}
