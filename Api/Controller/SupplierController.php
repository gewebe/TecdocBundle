<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Gweb\TecdocBundle\Api\Builder\SupplierBuilder;
use Gweb\TecdocBundle\Api\Model\Supplier;
use Swagger\Annotations as SWG;

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
     *
     * @SWG\Get(
     *   tags={"Supplier"},
     *   description="Return all suppliers",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Supplier::class))
     *     )
     *   )
     * )
     */
    public function supplierAction(): View
    {
        $dataSuppliers = $this->supplierBuilder->getSuppliers();

        return $this->view($dataSuppliers);
    }
}
