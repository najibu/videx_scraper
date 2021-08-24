<?php

namespace Tests\Unit;

use App\Builders\PackageBuilder;
use App\Services\ScraperInterface;
use PHPUnit\Framework\TestCase;

class PackageBuilderTest extends TestCase
{
    public function testBuilderExists()
    {
        $builder = PackageBuilder::scrape('Videx');

        $this->assertInstanceOf(ScraperInterface::class, $builder);
    }

    public function testWhenBuilderDoesntExist()
    {
        $this->expectException(\Exception::class);

        PackageBuilder::scrape('Google');
    }
}
