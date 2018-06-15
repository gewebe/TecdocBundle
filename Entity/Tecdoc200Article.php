<?php

namespace Gweb\TecdocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Gweb\TecdocBundle\Annotation as File;
use Gweb\TecdocBundle\Entity\Traits\DescriptionTrait;

/**
 * Tecdoc200Article
 *
 * @ORM\Table(name="Tecdoc200_Article", options={"comment"="Article main data table","engine"="InnoDB ROW_FORMAT=COMPRESSED"})
 * @ORM\Entity
 * @ORM\EntityListeners("Gweb\TecdocBundle\EventListener\TranslateListener")
 * @File\Table(name="200", provider=1)
 */
class Tecdoc200Article
{
    use DescriptionTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="DLNr", type="smallint", options={"unsigned"=true,"comment"="Data Supplier ID (-> 001)"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @File\Column(start=22, width=4)
     */
    private $dlnr = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ArtNr", type="string", length=22, options={"comment"="Article number in data supplier format"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @File\Column(start=0, width=22)
     */
    private $artnr = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="BezNr", type="integer", nullable=true, options={"unsigned"=true,"comment"="Description ID (-> 030)"})
     * @File\Column(start=29, width=9)
     */
    private $beznr;

    /**
     * @var \Gweb\TecdocBundle\Entity\Tecdoc001DataSupplier
     *
     * @ORM\ManyToOne(targetEntity="Tecdoc001DataSupplier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DLNr", referencedColumnName="DLNr")
     * })
     * @Serializer\Exclude()
     */
    private $datasupplier;

    /**
     * @return int
     */
    public function getDlnr(): int
    {
        return $this->dlnr;
    }

    /**
     * @param int $dlnr
     * @return Tecdoc200Article
     */
    public function setDlnr(int $dlnr): Tecdoc200Article
    {
        $this->dlnr = $dlnr;

        return $this;
    }

    /**
     * @return string
     */
    public function getArtnr(): string
    {
        return $this->artnr;
    }

    /**
     * @param string $artnr
     * @return Tecdoc200Article
     */
    public function setArtnr(string $artnr): Tecdoc200Article
    {
        $this->artnr = $artnr;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBeznr(): ?int
    {
        return $this->beznr;
    }

    /**
     * @param int|null $beznr
     * @return Tecdoc200Article
     */
    public function setBeznr(?int $beznr): Tecdoc200Article
    {
        $this->beznr = $beznr;

        return $this;
    }

    /**
     * @return Tecdoc001DataSupplier
     */
    public function getDatasupplier(): Tecdoc001DataSupplier
    {
        return $this->datasupplier;
    }

    /**
     * @param Tecdoc001DataSupplier $datasupplier
     * @return Tecdoc200Article
     */
    public function setDatasupplier(Tecdoc001DataSupplier $datasupplier): Tecdoc200Article
    {
        $this->datasupplier = $datasupplier;

        return $this;
    }

}
