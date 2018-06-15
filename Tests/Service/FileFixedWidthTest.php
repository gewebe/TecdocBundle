<?php

namespace Gweb\TecdocBundle\Tests\Service;

use Gweb\TecdocBundle\Service\FileFixedWidth;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

/**
 * Test Case for FileFixedWidth
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class FileFixedWidthTest extends TestCase
{

    public function testFile()
    {
        $file = new FileFixedWidth(__DIR__ . '/../Fixtures/supplier/2562/001.2562');

        $file->addColumn('dlnr', 0, 4);

        self::assertArraySubset(['dlnr' => 2562], $file->getRow());

        // empty last line
        self::assertEquals(false, $file->getRow());

        // eof
        self::assertEquals(false, $file->getRow());
    }


    public function testWrongFile()
    {
        self::expectException(FileNotFoundException::class);

        new FileFixedWidth(__DIR__ . '/../Fixtures/supplier/2562/001.1112');
    }

}
