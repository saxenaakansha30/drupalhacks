<?php
/**
 * @file
 * Provides Drupal\drupalhacks\HumanBase.
 */

declare(strict_types = 1);

namespace Drupal\drupalhacks;

use Drupal\Component\Plugin\PluginBase;

class HumanBase extends PluginBase implements HumanInterface {

  /**
   * {@inheritdoc}
   */
  public function getId() {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function getNationality() {
    return $this->pluginDefinition['nationality'];
  }

  /**
   * {@inheritdoc}
   */
  public function getGender() {
    return $this->pluginDefinition['gender'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDob() {
    return $this->pluginDefinition['dob'];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->pluginDefinition['name'];
  }

}
