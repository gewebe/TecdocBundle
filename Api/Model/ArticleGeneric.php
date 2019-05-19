<?php

namespace Gweb\TecdocBundle\Api\Model;

class ArticleGeneric
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $nameAssembly;

    /**
     * @var string
     */
    private $nameStandardised;

    /**
     * @var string
     */
    private $nameUsage;

    /**
     * @var Category[]
     */
    private $categories;

    /**
     * @var Vehicle[]
     */
    private $vehicles;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNameAssembly(): string
    {
        return $this->nameAssembly;
    }

    /**
     * @param string $nameAssembly
     */
    public function setNameAssembly(string $nameAssembly): void
    {
        $this->nameAssembly = $nameAssembly;
    }

    /**
     * @return string
     */
    public function getNameStandardised(): string
    {
        return $this->nameStandardised;
    }

    /**
     * @param string $nameStandardised
     */
    public function setNameStandardised(string $nameStandardised): void
    {
        $this->nameStandardised = $nameStandardised;
    }

    /**
     * @return string
     */
    public function getNameUsage(): string
    {
        return $this->nameUsage;
    }

    /**
     * @param string $nameUsage
     */
    public function setNameUsage(string $nameUsage): void
    {
        $this->nameUsage = $nameUsage;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param Category[] $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return Vehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    /**
     * @param Vehicle[] $vehicles
     */
    public function setVehicles(array $vehicles): void
    {
        $this->vehicles = $vehicles;
    }
}
