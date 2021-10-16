<?php

declare(strict_types = 1);

namespace Drupal\Tests\drupalhacks\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests that the Config page is reachable.
 *
 * @group drupalhacks
 */
class DrupalhakcsSettingsPageTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['drupalhacks'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() : void {
    parent::setUp();

    // Create and log in an administrative user.
    $this->adminUser = $this->drupalCreateUser([
      'access administration pages',
    ]);
    $this->drupalLogin($this->adminUser);
  }

  /**
   * Test if settings page is reachable.
   */
  public function testIsPageReachable() : void {
    $this->drupalGet('admin/config/drupalhacks');
    $this->assertSession()->statusCodeEquals(200);
  }

}
