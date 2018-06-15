<?php

namespace Gweb\TecdocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gweb\TecdocBundle\Annotation as File;

/**
 * Tecdoc020Language
 *
 * @ORM\Table(name="Tecdoc020_Language", options={"comment"="Description of the languages","engine"="InnoDB ROW_FORMAT=COMPRESSED"})
 * @ORM\Entity(repositoryClass="Gweb\TecdocBundle\Repository\LanguageRepository")
 * @File\Table(name="020", reference=1)
 */
class Tecdoc020Language
{
    /**
     * @var int
     *
     * @ORM\Column(name="SprachNr", type="smallint", options={"unsigned"=true,"comment"="Language ID"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @File\Column(start=29, width=3)
     */
    private $sprachnr = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ISOCode", type="string", length=2, nullable=true, options={"fixed"=true,"comment"="2-digit ISO-Code"})
     * @File\Column(start=41, width=2)
     */
    private $isocode;


    /**
     * @return int
     */
    public function getSprachnr(): int
    {
        return $this->sprachnr;
    }

    /**
     * @param int $sprachnr
     * @return Tecdoc020Language
     */
    public function setSprachnr(int $sprachnr): Tecdoc020Language
    {
        $this->sprachnr = $sprachnr;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getIsocode(): ?string
    {
        return $this->isocode;
    }

    /**
     * @param null|string $isocode
     * @return Tecdoc020Language
     */
    public function setIsocode(?string $isocode): Tecdoc020Language
    {
        $this->isocode = $isocode;

        return $this;
    }

}
