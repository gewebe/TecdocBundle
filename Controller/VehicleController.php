<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Gweb\TecdocBundle\Entity\Tecdoc100Manufacturer;
use Gweb\TecdocBundle\Entity\Tecdoc120VehicleType;
use Gweb\TecdocBundle\Entity\Tecdoc121VehicleTypeKba;
use Gweb\TecdocBundle\Service\EntityManager;

/**
 * Tecdoc Vehicle API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class VehicleController extends FOSRestController
{
    /**
     * @Rest\Get("/vehicle/manufacturer/{lang}")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleManufacturerAction()
    {
        return $this->getEntityManager()->getRepository(Tecdoc100Manufacturer::class)->findAll();
    }

    /**
     * @Rest\Get("/vehicle/car/manufacturer/{lang}")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarManufacturerAction()
    {
        return $this->getEntityManager()->getRepository(Tecdoc100Manufacturer::class)->findByPkw(true);
    }

    /**
     * @Rest\Get("/vehicle/cv/manufacturer/{lang}")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCvManufacturerAction()
    {
        return $this->getEntityManager()->getRepository(Tecdoc100Manufacturer::class)->findByNkw(true);
    }

    /**
     * @Rest\Get("/vehicle/car/{lang}/{ktypnr}")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarTypeAction(int $ktypnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc120VehicleType::class)->find($ktypnr);
    }

    /**
     * @Rest\Get("/vehicle/car/kba/{lang}/{kba}")
     * @View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarTypeByKbaAction(string $kba)
    {
        return $this->getEntityManager()->getRepository(Tecdoc121VehicleTypeKba::class)->findByKbanr($kba);
    }

    /**
     * get tecdoc entity manager
     * @return EntityManager
     */
    private function getEntityManager(): EntityManager
    {
        return $this->container->get('gweb_tecdoc.entity_manager');
    }
}
