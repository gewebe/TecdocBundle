<?php

namespace Gweb\TecdocBundle\Api\Builder;

use Gweb\TecdocBundle\Api\Model\Category;
use Gweb\TecdocBundle\Entity\Tecdoc301SearchTree;

class CategoryBuilder extends ApiBuilder
{
    /**
     * @param int $treeId
     * @return Category[]
     */
    public function getTree(int $treeId): array
    {
        $searchTree = $this->getRepository(Tecdoc301SearchTree::class)->getTree($treeId);

        $categories = [];

        foreach ($searchTree as $tecdocCategory) {
            $category = new Category();
            $category->setId($tecdocCategory->getNodeId());
            $category->setName($tecdocCategory->getDescription()->getBez());

            $categories[] = $category;
        }

        return $categories;
    }

    /**
     * @param int $nodeId
     * @return Category|null
     */
    public function getNode(int $nodeId): ?Category
    {
        /**
         * @var Tecdoc301SearchTree $node
         */
        $node = $this->getRepository(Tecdoc301SearchTree::class)->getNode($nodeId);

        if (!$node) {
            return null;
        }

        $category = new Category();
        $category->setId($node->getNodeId());
        $category->setName($node->getDescription()->getBez());

        foreach ($node->getChilds() as $child) {
            $childCategory = new Category();
            $childCategory->setId($child->getNodeId());
            $childCategory->setName($child->getDescription()->getBez());

           $category->addChild($childCategory);
        }

        return $category;
    }
}
