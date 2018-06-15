<?php

namespace Gweb\TecdocBundle\Tests\Fixtures;

use Gweb\TecdocBundle\Annotation as File;

/**
 * TestEntity for FileAnnotationTest
 *
 * @File\Table(name="001", reference=1, provider=1)
 */
class TestEntity001
{
    /**
     * @var int
     *
     * @File\Column(start=0, width=4)
     */
    private $dlnr = '0';

    /**
     * @var string
     *
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
     * @return TestEntity001
     */
    public function setDlnr(int $dlnr): TestEntity001
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
     * @return TestEntity001
     */
    public function setMarke(string $marke): TestEntity001
    {
        $this->marke = $marke;

        return $this;
    }

}
