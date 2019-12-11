<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Contracts\Providers\ComposerContract;

final class ScheduleListInstallTest extends TestCase
{
    public function testRequiredPackages(): void
    {
        $composerMock = $this->createMock(ComposerContract::class);

        $composerMock->expects($this->once())
            ->method('require')
            ->with('hmazter/laravel-schedule-list "^2.0"');

        $this->app->instance(ComposerContract::class, $composerMock);

        Artisan::call('app:install', ['component' => 'schedule-list']);
    }

    public function testCopyStubs(): void
    {
        $composerMock = $this->createMock(ComposerContract::class);
        $composerMock->method('require');
        $this->app->instance(ComposerContract::class, $composerMock);

        Artisan::call('app:install', ['component' => 'schedule-list']);

        $this->assertTrue(File::exists(config_path('schedule-list.php')));
    }
}