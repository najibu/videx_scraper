<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

/**
 * interface for the scaper
 */
interface ScraperInterface
{
    /**
     * @return Crawler
     */
    public function crawler(): Crawler;

    /**
     * Returns all packages
     * @return array
     */
    public function packages(): array;
}
