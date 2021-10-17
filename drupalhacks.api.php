<?php

/**
 * @file
 * Hooks specific to the drupalhacks module.
 */

declare(strict_types=1);

/**
 * Generates list of top hacks of drupalhacks.
 *
 * This hook serves the list of the latest created nodes tagged with
 * hacks taxonomy and that list has the item specified by the argument $number.
 *
 * @param int $list
 *   List of nodes.
 *
 * @return array
 *   List of top nodes tagged with hacks tax.
 */
function hook_drupalhacks_latest_hacks(&$list): void {
  foreach ($list as $key => $nid) {
    // Implement your logic on respective nid.
  }
}
