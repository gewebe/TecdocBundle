<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Gweb\TecdocBundle\Entity\Tecdoc001DataSupplier;

/**
 * Tecdoc Datasupplier API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class DatasupplierController extends FOSRestController
{
    /**
     * @Rest\Get("/datasupplier")
     */
    public function datasupplierAction()
    {
        $em = $this->getDoctrine()->getManager('tecdoc');

        return $em->getRepository(Tecdoc001DataSupplier::class)->findAll();
    }
}
