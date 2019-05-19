<?php

namespace Gweb\TecdocBundle\Api\Model;

class ArticleVehicle
{
    /**
     * @var Vehicle
     */
    private $vehicle;

    /**
     * @var array
     */
    private $images;

    /**
     * @var array
     */
    private $criterias;

    /**
     * @var array
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
