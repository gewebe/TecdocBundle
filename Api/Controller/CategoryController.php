<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\CategoryBuilder;
use Gweb\TecdocBundle\Api\Model\Category;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class CategoryController extends AbstractFOSRestController
{
    /**
     * @var CategoryBuilder
     */
    private $categoriesBuilder;

    public function __construct(CategoryBuilder $categoriesBuilder)
    {
        $this->categoriesBuilder = $categoriesBuilder;
    }

    /**
     * @Rest\Get("/category")
     * @Rest\QueryParam(name="treeId", requirements="\d+", default="1", description="Tree-ID (TreeTypeNr)")
     *
     * @SWG\Get(
     *   tags={"Catalog"},
     *   description="Find first level tree categories",
     *   @SWG\Response(
     *     response=200,
     *     description="Categories",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Category::class, groups={"list"}))
     *     )
     *   )
     * )
     */
    public function categoryByTreeAction(ParamFetcherInterface $paramFetcher): View
    {
        $treeId = $paramFetcher->get('treeId');

        $categories = $this->categoriesBuilder->getTree($treeId);

        return $this->view($categories);
    }

    /**
     * @Rest\Get("/category/{categoryId}")
     *
     * @SWG\Get(
     *   tags={"Catalog"},
     *   description="Find a category with childs",
     *   @SWG\Response(
     *     response=200,
     *     description="Category",
     *     @Model(type=Category::class)
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Category not found"
     *   )
     * )
     * @SWG\Parameter(
     *   name="categoryId",
     *   description="Category-ID (Node_Id)",
     *   type="integer",
     *   in="path",
     *   required=true
     * )
     */
    public function categoryAction(int $categoryId): View
    {
        $category = $this->categoriesBuilder->getCategory($categoryId);

        if (!$category) {
            throw $this->createNotFoundException('Category not found');
        }

        return $this->view($category);
    }
}
