<?php

namespace Tests\Unit;

use App\Services\Package;
use App\Services\VidexScraper;
use PHPUnit\Framework\TestCase;

class VidexScraperTest extends TestCase
{
    public function testResponseContainsPackages()
    {
        $this->scraperMock = $this->createVidexScraperMock();
        $packages = $this->scraperMock->packages();

        $this->assertCount(1, $packages);

        $package = $packages[0];

        $this->assertEquals('Option 160 Mins', $package->getTitle());
        $this->assertEquals('Up to 40 minutes talk', $package->getDescription());
        $this->assertEquals(16.0, $package->getPrice());
        $this->assertEquals(5.0, $package->getDiscount());
    }

    protected function createVidexScraperMock()
    {
        $scraperMock = $this->createMock(VidexScraper::class);

        $scraperMock->method('packages')
            ->willReturn([
                $this->createPackageMock()
            ]);

        return $scraperMock;
    }

    protected function createPackageMock()
    {
        $packageMock = $this->createMock(Package::class);

        $packageMock->method('getTitle')
            ->willReturn('Option 160 Mins');
        $packageMock->method('getDescription')
            ->willReturn('Up to 40 minutes talk');
        $packageMock->method('getPrice')
            ->willReturn(16.0);
        $packageMock->method('getDiscount')
            ->willReturn(5.0);

        return $packageMock;
    }
}
