<?php

namespace Onwwward\Bugherd\Tests;

use Bugherd\Client;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the servicer provider test class.
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testBugherdClientIsInjectable()
    {
        $this->assertIsInjectable(Client::class);
    }
}
