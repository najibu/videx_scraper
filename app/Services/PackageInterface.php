<?php

namespace App\Services;

interface PackageInterface
{
    /**
     * @param string $title
     */
    public function setTitle(string $title);

    /**
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * @param float $price
     */
    public function setPrice(float $price);

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount);

    /**
    * @return string
    */
    public function getTitle(): string;

    /**
    * @return string
    */
    public function getDescription(): string;

    /**
    * @return float
    */
    public function getPrice(): float;

    /**
     * @return float
     */
    public function getDiscount(): float;
}
