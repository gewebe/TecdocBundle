<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
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
    public function searchtreeAction(int $id)
    {
        $em = $this->getDoctrine()->getManager('tecdoc');

        return $em->getRepository(Tecdoc301SearchTree::class)->getTree($id);
    }

    /**
     * @Rest\Get("/searchnode/{lang}/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"Default", "node"})
     */
    public function searchnodeAction(string $lang, int $id)
    {
        $em = $this->getDoctrine()->getManager('tecdoc');

        return $em->getRepository(Tecdoc301SearchTree::class)->find($id);
    }
}
