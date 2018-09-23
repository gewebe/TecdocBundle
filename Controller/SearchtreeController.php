<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc301SearchTree;

/**
 * Tecdoc Searchtree API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class SearchtreeController extends FOSRestController
{
    /**
     * @Rest\Get("/searchtree/{lang}/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"Default", "tree"})
     */
    public function searchtreeAction(int $id): View
    {
        $entityManager = $this->get('gweb_tecdoc.entity_manager');

        $searchTree = $entityManager->getRepository(Tecdoc301SearchTree::class)->getTree($id);

        return $this->view($searchTree);
    }

    /**
     * @Rest\Get("/searchnode/{lang}/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"Default", "node"})
     */
    public function searchnodeAction(int $id): View
    {
        $entityManager = $this->get('gweb_tecdoc.entity_manager');

        $searchNode = $entityManager->getRepository(Tecdoc301SearchTree::class)->find($id);

        return $this->view($searchNode);
    }
}
