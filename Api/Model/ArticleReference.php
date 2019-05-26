<?php

namespace Gweb\TecdocBundle\Api\Model;

use Swagger\Annotations as SWG;

class ArticleReference
{
    /**
     * @var string
     * @SWG\Property(type="string", example="AUDI")
     */
    private $manufacturer;

    /**
     * @var array
     * @SWG\Property(type="array", @SWG\Items(type="string"))
     */
    private $numbers;

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return array
     */
    public function getNumbers(): array
    {
        return $this->numbers;
    }

    /**
     * @param array $numbers
     */
    public function setNumbers(array $numbers): void
    {
        $this->numbers = $numbers;
    }

    /**
     * @param string $number
     * @return void
     */
    public function addNumbers(string $number): void
    {
        $this->numbers[] = $number;
    }
}
