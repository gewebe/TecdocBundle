<?php

namespace Gweb\TecdocBundle\Entity\Traits;

use Gweb\TecdocBundle\Entity\Tecdoc012CountryDescription;

/**
 * Translate country and language description
 * @package Gweb\TecdocBundle\Entity\Traits
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
trait CountryDescriptionTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="Gweb\TecdocBundle\Entity\Tecdoc012CountryDescription", fetch="LAZY")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="LBezNr", referencedColumnName="LBezNr", nullable=true)
     * })
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
