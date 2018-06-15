<?php

namespace Gweb\TecdocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gweb\TecdocBundle\Annotation as File;

/**
 * Tecdoc001DataSupplier
 *
 * @ORM\Table(name="Tecdoc001_DataSupplier", options={"comment"="Data Supplier","engine"="InnoDB ROW_FORMAT=COMPRESSED"})
 * @ORM\Entity
 * @File\Table(name="001", reference=1, provider=1)
 */
class Tecdoc001DataSupplier
{
    /**
     * @var int
     *
     * @ORM\Column(name="DLNr", type="smallint", options={"unsigned"=true,"comment"="Data Supplier ID"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @File\Column(start=0, width=4)
     */
    private $dlnr = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Marke", type="string", length=20, nullable=false, options={"comment"="Brand"})
     * @File\Column(start=26, width=20)
     */
    private $marke = '';

    /**
     * @return int
     */
    public function getDlnr(): int
    {
        return $this->dlnr;
    }

    /**
     * @param int $dlnr
     * @return Tecdoc001DataSupplier
     */
    public function setDlnr(int $dlnr): Tecdoc001DataSupplier
    {
        $this->dlnr = $dlnr;

        return $this;
    }

    /**
     * @return string
     */
    public function getMarke(): string
    {
        return $this->marke;
    }

    /**
     * @param string $marke
     * @return Tecdoc001DataSupplier
     */
    public function setMarke(string $marke): Tecdoc001DataSupplier
    {
        $this->marke = $marke;

        return $this;
    }

}
