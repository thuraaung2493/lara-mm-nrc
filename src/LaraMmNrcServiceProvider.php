<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc;

use Illuminate\Support\ServiceProvider;

final class LaraMmNrcServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/lara-mm-nrc.php',
            'lara-mm-nrc'
        );
    }

    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../config/lara-mm-nrc.php' => config_path('lara-mm-nrc.php'),
            ],
            groups: 'lara-mm-nrc',
        );
    }
}
