<?php

namespace Gweb\TecdocBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Gweb\TecdocBundle\Annotation\Table;
use Gweb\TecdocBundle\Service\ImportManager;

/**
 * Test Case for ImportManager
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ImportManagerTest extends TestCase
{

    public function testEntityFiles()
    {
        // mock entity manager
        $objectManager = $this->createMock(ObjectManager::class);

        // mock table annotation
        $table = new Table(
            [
            'name' => '001',
            'reference' => true,
            'provider' => true,
            ]
        );

        $import = new ImportManager($objectManager,
            __DIR__.'/../Fixtures/reference',
            __DIR__.'/../Fixtures/supplier');

        $files = $import->getEntityFiles($table);

        self::assertArraySubset([0 => __DIR__.'/../Fixtures/supplier/2562/001.2562'], $files);
    }

}
