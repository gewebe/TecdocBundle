<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc052KeyTableEntry;

/**
 * Tecdoc KeyTable API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class KeytableController extends ApiController
{
    /**
     * @Rest\Get("/keytable/{lang}/{tabnr}/{key}")
     */
    public function keyTableEntryAction(int $tabnr, string $key): View
    {
        $repository = $this->getRepository(Tecdoc052KeyTableEntry::class);
        $keyEntry = $repository->findKeyEntry($tabnr, $key);

        return $this->view($keyEntry);
    }
}
