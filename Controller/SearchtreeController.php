<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc301SearchTree;

/**
 * Tecdoc Searchtree API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class SearchtreeController extends ApiController
{
    /**
     * @Rest\Get("/searchtree/{lang}/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"Default", "tree"})
     */
    public function searchtreeAction(int $id): View
    {
        $searchTree = $this->getRepository(Tecdoc301SearchTree::class)->getTree($id);

        return $this->view($searchTree);
    }

    /**
     * @Rest\Get("/searchnode/{lang}/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"Default", "node"})
     */
    public function searchnodeAction(int $id): View
    {
        $searchNode = $this->getRepository(Tecdoc301SearchTree::class)->getNode($id);

        return $this->view($searchNode);
    }
}
