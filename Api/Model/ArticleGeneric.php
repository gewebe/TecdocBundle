<?php

namespace Gweb\TecdocBundle\Api\Model;

use JMS\Serializer\Annotation as JMS;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class ArticleGeneric
{
    /**
     * @var int
     * @JMS\Groups({"list"})
     * @SWG\Property(type="integer", example=13)
     */
    private $id;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="Drive Shaft")
     */
    private $name;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="Final Drive")
     */
    private $nameAssembly;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="Shaft")
     */
    private $nameStandardised;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="Drive Shaft")
     */
    private $nameUsage;

    /**
     * @var Category[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=Category::class)))
     */
    private $categories;

    /**
     * @var ArticleVehicle[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleVehicle::class)))
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
     * @return ArticleVehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    /**
     * @param ArticleVehicle[] $vehicles
     */
    public function setVehicles(array $vehicles): void
    {
        $this->vehicles = $vehicles;
    }
}
