<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Thuraaung\LaraMmNrc\LaraMmNrcServiceProvider;

final class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaraMmNrcServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     * @return array<string,class-string<Facade>>
     */
    protected function getPackageAliases($app): array
    {
        return [];
    }
}
