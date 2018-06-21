<?php

namespace Gweb\TecdocBundle\Tests\Service;

use Gweb\TecdocBundle\Service\FileExtract;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Test Case for FileExtract
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class FileExtractTest extends TestCase
{
    public function testSuppliers()
    {
        // cleanup from last test
        $filesystem = new Filesystem();
        if ($filesystem->exists('/tmp/supplier')) {
            $filesystem->remove('/tmp/supplier');
        }

        FileExtract::suppliers(__DIR__.'/../Fixtures/download/supplier', '/tmp/supplier');

        self::assertFileIsReadable('/tmp/supplier/2562/001.2562');
    }
}
