<?php

namespace App\Services;

class Package implements PackageInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var int
     */
    protected $discount;

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = floatval($price);
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount)
    {
        $this->discount = floatval($discount);
    }

    /**
    * @return string
    */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
    * @return string
    */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
    * @return float
    */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }
}
