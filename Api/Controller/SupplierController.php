<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\ArticleBuilder;
use Nelmio\ApiDocBundle\Annotation\Model;
use Gweb\TecdocBundle\Api\Builder\SupplierBuilder;
use Gweb\TecdocBundle\Api\Model\Article;
use Gweb\TecdocBundle\Api\Model\Supplier;
use Swagger\Annotations as SWG;

class SupplierController extends AbstractFOSRestController
{
    /**
     * @var SupplierBuilder
     */
    private $supplierBuilder;

    /**
     * @var ArticleBuilder
     */
    private $articleBuilder;

    public function __construct(
        SupplierBuilder $supplierBuilder,
        ArticleBuilder $articleBuilder
    ) {
        $this->supplierBuilder = $supplierBuilder;
        $this->articleBuilder = $articleBuilder;
    }

    /**
     * @Rest\Get("/supplier")
     *
     * @SWG\Get(
     *   tags={"Supplier"},
     *   description="Return all suppliers",
     *   @SWG\Response(
     *     response=200,
     *     description="Suppliers",
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

    /**
     * @Rest\Get("/supplier/{supplierId}/article")
     *
     * @SWG\Get(
     *   tags={"Supplier"},
     *   description="Find suppliers articles",
     *   @SWG\Response(
     *     response=200,
     *     description="Supplier Articles",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"list"}))
     *     )
     *   )
     * )
     * @SWG\Parameter(
     *   name="supplierId",
     *   description="Supplier-ID (DLNr)",
     *   type="integer",
     *   in="path",
     *   required=true
     * )
     */
    public function articleBySupplierAction(int $supplierId): View
    {
        $articles = $this->articleBuilder->getArticles($supplierId);

        return $this->view($articles);
    }
}
