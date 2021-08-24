<?php

namespace App\Services;

use Goutte\Client;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

/**
 *  class VidexScraper
 *
 * @package App\Services
 */
class VidexScraper implements ScraperInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * @return Crawler
     */
    public function crawler(): Crawler
    {
        return $this->client->request('GET', 'https://videx.comesconnected.com/');
    }

    /**
     * @return array
     */
    public function packages(): array
    {
        $packages = [];

        foreach ($this->crawler()->filter('.package') as $domElement) {
            $crawler = new Crawler($domElement);
            $package = new Package();

            $title = $crawler->filter('h3')->text();
            $description = $crawler->filter('.package-name')->text();
            $price = $this->extractPrice($crawler);
            $discount = $this->extractDiscount($crawler);

            $package->setTitle($title);
            $package->setDescription($description);
            $package->setPrice($price);
            $package->setDiscount($discount);

            array_push($packages, $package);
        }

        return $packages;
    }

    /**
     * @param  Crawler $crawler
     * @return float
     */
    protected function extractPrice(Crawler $crawler): float
    {
        $text = $crawler->filter('div.package-price span.price-big')->text();

        return (float) Str::of($text)
            ->replace('£', '')
            ->__toString();
    }

    /**
     * @param  Crawler $crawler
     * @return float
     */
    protected function extractDiscount(Crawler $crawler): float
    {
        $discountText = $crawler->filter('div.package-price')
                ->children()
                ->last()
                ->text();

        return (float) Str::of($discountText)
                ->between('Save ', ' on')
                ->replace('£', '')
                ->__toString();
    }
}
