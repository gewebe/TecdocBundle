<?php

namespace Gweb\TecdocBundle\Entity\Traits;

use Doctrine\Common\Collections\Collection;
use Gweb\TecdocBundle\Entity\Tecdoc035TextModule;

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
     * @return Collection|null
     */
    public function getTextmodule(): ?Collection
    {
        return $this->textmodule;
    }

    /**
     * @param Collection|null $textmodule
     */
    public function setTextmodule(?Collection $textmodule): void
    {
        $this->textmodule = $textmodule;
    }

    /**
     * @param Tecdoc035TextModule $textmodule
     */
    public function addTextmodule(Tecdoc035TextModule $textmodule): void
    {
        $this->textmodule->add($textmodule);
    }
}
