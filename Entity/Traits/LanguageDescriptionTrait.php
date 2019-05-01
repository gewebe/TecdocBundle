<?php

namespace Gweb\TecdocBundle\Entity\Traits;

/**
 * Translate language description
 * @package Gweb\TecdocBundle\Entity\Traits
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
trait LanguageDescriptionTrait
{
    /**
     * @var string
     */
    private $description;

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
