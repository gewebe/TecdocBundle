<?php

namespace Gweb\TecdocBundle\Api\Model;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class ArticleVehicle
{
    /**
     * @var Vehicle
     * @SWG\Property(ref=@Model(type=Vehicle::class))
     */
    private $vehicle;

    /**
     * @var array
     * @SWG\Property(type="array", @SWG\Items(type="string"))
     */
    private $images;

    /**
     * @var ArticleCriteria[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleCriteria::class)))
     */
    private $criterias;

    /**
     * @var ArticleText[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleText::class)))
     */
    private $texts;

    /**
     * @return Vehicle
     */
    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    /**
     * @param Vehicle $vehicle
     */
    public function setVehicle(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * @return array
     */
    public function getCriterias(): array
    {
        return $this->criterias;
    }

    /**
     * @param array $criterias
     */
    public function setCriterias(array $criterias): void
    {
        $this->criterias = $criterias;
    }

    /**
     * @return array
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    /**
     * @param array $texts
     */
    public function setTexts(array $texts): void
    {
        $this->texts = $texts;
    }
}
