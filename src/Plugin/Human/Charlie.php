<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Human;

use Drupal\drupalhacks\HumanBase;

/**
 * Create human type plugin.
 *
 * @HumanData(
 *   id = 1,
 *   gender = "male",
 *   nationality = "indian",
 *   dob = "1/11/1978",
 *   name = "Charlie"
 * )
 *
 */
class Charlie extends HumanBase {

  public function getNationality()
  {
    return "hello";
  }

}
