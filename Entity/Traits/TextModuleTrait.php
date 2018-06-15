<?php

namespace Gweb\TecdocBundle\Entity\Traits;

/**
 * Translate text module
 * @package Gweb\TecdocBundle\Entity\Traits
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
trait TextModuleTrait
{
    /**
     * @var string|null
     */
    private $textmodule;

    /**
     * @return string|null
     */
    public function getTextmodule(): ?string
    {
        return $this->textmodule;
    }

    /**
     * @param string|null $textmodule
     */
    public function setTextmodule(?string $textmodule): void
    {
        $this->textmodule = $textmodule;
    }
}
