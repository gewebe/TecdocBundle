<?php

namespace Gweb\TecdocBundle\Entity\Traits;

use Gweb\TecdocBundle\Entity\Tecdoc231Image;

/**
 * Translate image
 * @package Gweb\TecdocBundle\Entity\Traits
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
trait ImageTrait
{
    /**
     * @var Tecdoc231Image|null
     */
    private $image;

    /**
     * @return Tecdoc231Image|null
     */
    public function getImage(): ?Tecdoc231Image
    {
        return $this->image;
    }

    /**
     * @param Tecdoc231Image|null $image
     */
    public function setImage(?Tecdoc231Image $image): void
    {
        $this->image = $image;
    }
}
