<?php

namespace Gweb\TecdocBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc100Manufacturer;
use Gweb\TecdocBundle\Entity\Tecdoc120VehicleType;
use Gweb\TecdocBundle\Entity\Tecdoc121VehicleTypeKba;

/**
 * Tecdoc Vehicle API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class VehicleController extends FOSRestController
{
    /**
     * @Rest\Get("/vehicle/manufacturer/{lang}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleManufacturerAction(): View
    {
        $repository = $this->getRepository(Tecdoc100Manufacturer::class);
        $vehicleManufacturers = $repository->findAll();

        return $this->view($vehicleManufacturers);
    }

    /**
     * @Rest\Get("/vehicle/car/manufacturer/{lang}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarManufacturerAction(): View
    {
        $repository = $this->getRepository(Tecdoc100Manufacturer::class);
        $vehicleManufacturers = $repository->findByPkw(true);

        return $this->view($vehicleManufacturers);
    }

    /**
     * @Rest\Get("/vehicle/cv/manufacturer/{lang}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCvManufacturerAction(): View
    {
        $repository = $this->getRepository(Tecdoc100Manufacturer::class);
        $vehicleManufacturers = $repository->findByNkw(true);

        return $this->view($vehicleManufacturers);
    }

    /**
     * @Rest\Get("/vehicle/car/{lang}/{ktypnr}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarTypeAction(int $ktypnr): View
    {
        $repository = $this->getRepository(Tecdoc120VehicleType::class);
        $vehicle = $repository->find($ktypnr);

        return $this->view($vehicle);
    }

    /**
     * @Rest\Get("/vehicle/car/kba/{lang}/{kba}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarTypeByKbaAction(string $kba): View
    {
        $repository = $this->getRepository(Tecdoc121VehicleTypeKba::class);
        $vehicle = $repository->findByKbanr($kba);

        return $this->view($vehicle);
    }

    /**
     * get tecdoc entity manager
     * @param string $className
     * @return ObjectRepository
     */
    private function getRepository(string $className): ObjectRepository
    {
        return $this->get('gweb_tecdoc.entity_manager')->getRepository($className);
    }
}
