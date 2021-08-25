<?php

namespace Tests\Unit;

use App\Builders\PackageBuilder;
use App\Console\Commands\ScrapeSite;
use App\Services\Package;
use App\Services\VidexScraper;
use Tests\TestCase;

class ScrapeSiteCommandTest extends TestCase
{
    public function testItHasScrapeVidexCommand()
    {
        $this->assertTrue(class_exists(ScrapeSite::class));
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testCanScrapeSite()
    {
        $builder = $this->mock('alias:App\Builders\PackageBuilder');

        $builder->shouldReceive('scrape')
            ->with('videx')
            ->andReturn($this->createVidexScraperMock());

        $this->instance(
            PackageBuilder::class,
            $builder
        );

        $this->artisan('scrape:site videx')
            ->expectsOutput('[{"title":"Option 160 Mins","description":"Up to 40 minutes talk","price":16,"discount":5}]')
            ->assertExitCode(0);
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
