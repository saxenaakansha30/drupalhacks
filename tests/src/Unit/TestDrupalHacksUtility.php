<?php

declare(strict_types = 1);

namespace Drupal\Tests\drupalhacks\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\drupalhacks\Utility;

/**
 * Tests Drupalhacks Utility Functions.
 *
 * @group drupalhacks
 */
class TestDrupalHacksUtility extends UnitTestCase {

  /**
   * Druplhacks Utility object.
   *
   * @var object
   */
  protected $utility;

  /**
   * {@inheritdoc}
   *
   * It runs for all tests written in this class before running them.
   * So write the commono logic of the all the tests of this class here.
   */
  protected function setUp(): void {
    $this->utility = new Utility();
    parent::setUp();
  }

  /**
   * Tests local task existence.
   */
  public function testWithoutSpecialCharacters() {
    $this->assertEquals(FALSE, $this->utility->hasSpecialCharacters('This is simple string.'));
  }

  /**
   * Test with special characters.
   *
   * @covers Drupal\drupalhacks\Utility
   */
  public function testSpecialCharacters($value='') {
    $this->assertEquals(FALSE, $this->utility->hasSpecialCharacters('This has special characters @##%$^%&*&'));
  }

}
