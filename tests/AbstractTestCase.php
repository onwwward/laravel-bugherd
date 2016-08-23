<?php

namespace Onwwward\Bugherd\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Onwwward\Bugherd\BugherdServiceProvider;

/**
 * This is the abstract class.
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
   * @before
   */
  public function setTheApiKey()
  {
      $this->app->config->set('bugherd.apikey', 'abcdefg');
  }

  /**
   * Get the service provider class.
   *
   * @return string
   */
  protected function getServiceProviderClass($app)
  {
      return BugherdServiceProvider::class;
  }
}
