<?php

namespace App\Builders;

use App\Services\ScraperInterface;

class PackageBuilder
{
    /**
     * @param  string $name
     * @throws \Exception
     * @return ScraperInterface
     */
    public static function scrape(string $name): ScraperInterface
    {
        $className = "App\\Services\\" . ucfirst($name) ."Scraper";

        if (!class_exists($className)) {
            $message = sprintf('Cannot scrape %s as class does not exist', $name);

            throw new \Exception($message);
        }

        return new $className();
    }
}
