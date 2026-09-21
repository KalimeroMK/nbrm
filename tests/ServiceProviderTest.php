<?php

declare(strict_types=1);

namespace Kalimeromk\Nbrm\Tests;

use Orchestra\Testbench\TestCase;

/**
 * Laravel instantiates whatever auto-discovery declares, so a provider or alias
 * that does not exist is a fatal error on boot.
 */
final class ServiceProviderTest extends TestCase
{
    public function testEverythingDeclaredForAutoDiscoveryExists(): void
    {
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../composer.json'), true);
        $laravel = $manifest['extra']['laravel'] ?? [];

        $this->assertNotSame([], $laravel, 'The package declares itself as a Laravel package');

        foreach ($laravel['providers'] ?? [] as $provider) {
            $this->assertTrue(class_exists($provider), $provider . ' is declared but does not exist');
        }

        foreach ($laravel['aliases'] ?? [] as $alias => $class) {
            $this->assertTrue(class_exists($class), $class . ' is aliased as ' . $alias . ' but does not exist');
        }
    }
}
