<?php

namespace Gweb\TecdocBundle\Api\Builder;

use Gweb\TecdocBundle\Api\Model\Supplier;
use Gweb\TecdocBundle\Entity\Tecdoc001DataSupplier;

class SupplierBuilder extends ApiBuilder
{
    /**
     * @return array
     */
    public function getSuppliers(): array
    {
        $dataSuppliers = $this->getRepository(Tecdoc001DataSupplier::class)->findAll();

        $suppliers = [];

        foreach ($dataSuppliers as $dataSupplier) {
            $supplier = new Supplier();
            $supplier->setId($dataSupplier->getDlnr());
            $supplier->setName($dataSupplier->getMarke());

            $suppliers[] = $supplier;
        }

        return $suppliers;
    }
}
