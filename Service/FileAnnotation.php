<?php

namespace Gweb\TecdocBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Gweb\TecdocBundle\Annotation\Column;
use Gweb\TecdocBundle\Annotation\Table;

/**
 * File annotation reader
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class FileAnnotation
{
    /**
     * @var Table
     */
    private $table;

    /**
     * @var Column[]
     */
    private $columns = [];

    /**
     * FileAnnotation constructor.
     * @param string $entityClass
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function __construct(string $entityClass)
    {
        $this->loadSchema($entityClass);
    }

    /**
     * read entity file schema
     * @param string $entityClass
     * @return void
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function loadSchema(string $entityClass): void
    {
        AnnotationRegistry::registerLoader('class_exists');

        $reader = new AnnotationReader();

        $reflectionObj = new \ReflectionObject(new $entityClass);

        $this->setTable($reader, $reflectionObj);
        $this->setColumns($reader, $reflectionObj);
    }

    /**
     * read table annotation
     * @param AnnotationReader $reader
     * @param \ReflectionObject $reflectionObj
     * @return void
     */
    private function setTable(AnnotationReader $reader, \ReflectionObject $reflectionObj)
    {
        $tableAnnotations = $reader->getClassAnnotations($reflectionObj);
        foreach ($tableAnnotations as $tableAnnotation) {
            if ($tableAnnotation instanceof Table) {
                $this->table = $tableAnnotation;
            }
        }
    }

    /**
     * read columns annotations and inherit name and type from orm
     * @param AnnotationReader $reader
     * @param \ReflectionObject $reflectionObj
     * @return void
     */
    private function setColumns(AnnotationReader $reader, \ReflectionObject $reflectionObj)
    {
        foreach ($reflectionObj->getProperties() as $property)
        {
            $propertyAnnotations = $reader->getPropertyAnnotations($property);
            $ormAnnotation = false;

            foreach ($propertyAnnotations as $annotation) {
                if ($annotation instanceof \Doctrine\ORM\Mapping\Column) {
                    $ormAnnotation = $annotation;
                }
                if ($annotation instanceof Column) {
                    $this->columns[$property->getName()] = $annotation;
                }
            }

            // inherit orm column name
            if (isset($this->columns[$property->getName()])
              && isset($ormAnnotation->name)) {
                $this->columns[$property->getName()]->name = $ormAnnotation->name;
            }

            // inherit orm column type
            if (isset($this->columns[$property->getName()])
              && empty($this->columns[$property->getName()]->type)
              && isset($ormAnnotation->type)) {
                $this->columns[$property->getName()]->type = $ormAnnotation->type;
            }
        }
    }

    /**
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     * @return Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

}
