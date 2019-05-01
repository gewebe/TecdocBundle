<?php

namespace Gweb\TecdocBundle\Controller;

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
class VehicleController extends ApiController
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
     * @Rest\Get("/vehicle/car/{lang}/{ktypnr}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarTypeAction(int $ktypnr): View
    {
        $repository = $this->getRepository(Tecdoc120VehicleType::class);
        $vehicle = $repository->findVehicle($ktypnr);

        return $this->view($vehicle);
    }

    /**
     * @Rest\Get("/vehicle/car/kba/{lang}/{kba}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function vehicleCarTypeByKbaAction(string $kba): View
    {
        $repository = $this->getRepository(Tecdoc121VehicleTypeKba::class);
        $vehicle = $repository->findByKba($kba);

        return $this->view($vehicle);
    }
}
