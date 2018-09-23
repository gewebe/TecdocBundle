<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
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
    public function datasupplierAction(): View
    {
        $entityManager = $this->get('gweb_tecdoc.entity_manager');

        $dataSupplier = $entityManager->getRepository(Tecdoc001DataSupplier::class)->findAll();

        return $this->view($dataSupplier);
    }
}
