<?php

namespace Esign\ConversionsApi\Tests;

use Esign\ConversionsApi\ConversionsApiServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [ConversionsApiServiceProvider::class];
    }
}
