<?php

namespace Gweb\TecdocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gweb\TecdocBundle\Annotation as File;

/**
 * Tecdoc030LanguageDescription
 *
 * @ORM\Table(name="Tecdoc030_LanguageDescription", options={"comment"="Descriptions in different languages","engine"="InnoDB ROW_FORMAT=COMPRESSED"})
 * @ORM\Entity(repositoryClass="Gweb\TecdocBundle\Repository\LanguageDescriptionRepository")
 * @File\Table(name="030", reference=1, provider=1)
 */
class Tecdoc030LanguageDescription
{
    /**
     * @var int
     *
     * @ORM\Column(name="BezNr", type="integer", options={"unsigned"=true,"comment"="Language Description ID"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @File\Column(start=29, width=9)
     */
    private $beznr = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="SprachNr", type="smallint", options={"unsigned"=true,"comment"="Language ID (-> 020)"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @File\Column(start=38, width=3)
     */
    private $sprachnr = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Bez", type="string", length=60, nullable=true, options={"comment"="Description"})
     * @File\Column(start=41, width=60)
     */
    private $bez;

    /**
     * @return int
     */
    public function getBeznr(): int
    {
        return $this->beznr;
    }

    /**
     * @param int $beznr
     * @return Tecdoc030LanguageDescription
     */
    public function setBeznr(int $beznr): Tecdoc030LanguageDescription
    {
        $this->beznr = $beznr;

        return $this;
    }

    /**
     * @return int
     */
    public function getSprachnr(): int
    {
        return $this->sprachnr;
    }

    /**
     * @param int $sprachnr
     * @return Tecdoc030LanguageDescription
     */
    public function setSprachnr(int $sprachnr): Tecdoc030LanguageDescription
    {
        $this->sprachnr = $sprachnr;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBez(): ?string
    {
        return $this->bez;
    }

    /**
     * @param null|string $bez
     * @return Tecdoc030LanguageDescription
     */
    public function setBez(?string $bez): Tecdoc030LanguageDescription
    {
        $this->bez = $bez;

        return $this;
    }

}
