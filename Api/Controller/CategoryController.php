<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\CategoryBuilder;

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
     * @Rest\Get("/category/tree/{treeId}")
     */
    public function categoryTreeAction(int $treeId): View
    {
        $categories = $this->categoriesBuilder->getTree($treeId);

        return $this->view($categories);
    }

    /**
     * @Rest\Get("/category/{nodeId}")
     */
    public function categoryNodeAction(int $nodeId): View
    {
        $category = $this->categoriesBuilder->getNode($nodeId);

        if (!$category) {
            throw $this->createNotFoundException('Category not found');
        }

        return $this->view($category);
    }
}
