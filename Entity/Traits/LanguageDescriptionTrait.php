<?php

namespace Gweb\TecdocBundle\Entity\Traits;

use Gweb\TecdocBundle\Entity\Tecdoc030LanguageDescription;

/**
 * Translate language description
 * @package Gweb\TecdocBundle\Entity\Traits
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
trait LanguageDescriptionTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="Gweb\TecdocBundle\Entity\Tecdoc030LanguageDescription", fetch="LAZY")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="BezNr", referencedColumnName="BezNr", nullable=true)
     * })
     */
    private $description;

    /**
     * @return Tecdoc030LanguageDescription|null
     */
    public function getDescription(): ?Tecdoc030LanguageDescription
    {
        return $this->description;
    }

    /**
     * @param Tecdoc030LanguageDescription|null $description
     */
    public function setDescription(?Tecdoc030LanguageDescription $description): void
    {
        $this->description = $description;
    }
}
