<?php

namespace Gweb\TecdocBundle\Api\Model;

class ArticleReference
{
    /**
     * @var string
     */
    private $manufacturer;

    /**
     * @var array
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
