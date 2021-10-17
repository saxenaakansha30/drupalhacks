<?php

namespace Drupal\Tests\drupalhacks\Unit;

use Drupal\Tests\UnitTestCase;

/**
 * Sample test for certfication preparation.
 *
 * @group  drupalhacks
 */
class CertificationTest extends UnitTestCase
{

  protected function setUp() : void {
    parent::setUp();
  }

  /**
   * Tests any random assertion for certification.
   *
   * @coversDefaultClass Drupal\Tests\UnitTestCase
   *
   */
  public function testRandomForCertification() {
    $this->assertEquals(5,5);
  }

}
