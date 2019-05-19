<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\SupplierBuilder;

class SupplierController extends AbstractFOSRestController
{
    /**
     * @var SupplierBuilder
     */
    private $supplierBuilder;

    public function __construct(SupplierBuilder $supplierBuilder)
    {
        $this->supplierBuilder = $supplierBuilder;
    }

    /**
     * @Rest\Get("/supplier")
     */
    public function indexAction(): View
    {
        $dataSuppliers = $this->supplierBuilder->getSuppliers();

        return $this->view($dataSuppliers);
    }
}
