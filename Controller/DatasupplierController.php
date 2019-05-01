<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc001DataSupplier;

/**
 * Tecdoc Datasupplier API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class DatasupplierController extends ApiController
{
    /**
     * @Rest\Get("/datasupplier")
     */
    public function datasupplierAction(): View
    {
        $dataSupplier = $this->entityManager->getRepository(Tecdoc001DataSupplier::class)->findAll();

        return $this->view($dataSupplier);
    }
}
