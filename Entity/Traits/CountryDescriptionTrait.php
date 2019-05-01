<?php

namespace Gweb\TecdocBundle\Entity\Traits;

/**
 * Translate country and language description
 * @package Gweb\TecdocBundle\Entity\Traits
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
trait CountryDescriptionTrait
{
    /**
     * @var Tecdoc012CountryDescription|null
     */
    private $description;

    /**
     * @return Tecdoc012CountryDescription|null
     */
    public function getDescription(): ?Tecdoc012CountryDescription
    {
        return $this->description;
    }

    /**
     * @param Tecdoc012CountryDescription|null $description
     */
    public function setDescription(?Tecdoc012CountryDescription $description): void
    {
        $this->description = $description;
    }
}
