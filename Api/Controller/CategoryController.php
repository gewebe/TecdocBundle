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
     * @Rest\QueryParam(name="treeId", requirements="\d+", default="1", description="Tree-id to search for")
     *
     * @SWG\Get(
     *   tags={"Catalog"},
     *   description="Find categories by tree-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
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
     *   description="Find category with childs by id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @Model(type=Category::class)
     *   )
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
