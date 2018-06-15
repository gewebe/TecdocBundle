<?php

namespace Gweb\TecdocBundle\Tests\Service;

use Gweb\TecdocBundle\Annotation\Column;
use Gweb\TecdocBundle\Annotation\Table;
use Gweb\TecdocBundle\Service\FileAnnotation;
use Gweb\TecdocBundle\Tests\Fixtures\TestEntity001;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for FileAnnotation
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class FileAnnotationTest extends TestCase
{

    public function testAnnotation()
    {
        $annotation = new FileAnnotation(TestEntity001::class);

        $table = $annotation->getTable();
        self::assertInstanceOf(Table::class, $table);
        self::assertEquals('001', $table->name);
        self::assertEquals(1, $table->reference);
        self::assertEquals(1, $table->provider);

        $columns = $annotation->getColumns();
        self::assertCount(2, $columns);

        self::assertArrayHasKey('dlnr', $columns);
        self::assertInstanceOf(Column::class, $columns['dlnr']);
        self::assertEquals(0, $columns['dlnr']->start);
        self::assertEquals(4, $columns['dlnr']->width);

        self::assertArrayHasKey('marke', $columns);
        self::assertInstanceOf(Column::class, $columns['marke']);
        self::assertEquals(26, $columns['marke']->start);
        self::assertEquals(20, $columns['marke']->width);
    }
}
