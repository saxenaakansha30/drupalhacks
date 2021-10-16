<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks;

/**
 * Servide defninig drupalhacks's basic functionalites.
 */
class Utility {

  /**
   * Check if passed value contains any special character.
   *
   * @param string $value
   *   String to test.
   *
   * @return bool
   *   Return true if passed string has special characters else false.
   */
  public function hasSpecialCharacters($value) {
    return preg_match('/[\'!^£$%&*()}{!@#~?><>,|=_+¬-]/', $value) ? TRUE : FALSE;
  }

  /**
   * Retun table renderable array of human plugin.
   *
   * @param array $pluginDefinitions
   *   Human Plugin Defination.
   *
   * @return array
   *   Renderable array in table format with human plugin info.
   */
  public function renderHumanInTable(array $pluginDefinitions) {
    $header = [
      'id' => t('IDentification Number'),
      'name' => t('Name'),
      'gender' => t('Gender'),
      'nationality' => t('Nationality'),
      'dob' => t('DOB'),
    ];
    foreach ($pluginDefinitions as $key => $row) {
      $rows[] = [
        $row['id'],
        $row['name'],
        $row['gender'],
        $row['nationality'],
        $row['dob'],
      ];
    }
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function homePage() {
    return [
      '#markup' => 'Hello, world',
    ];
  }

}
