<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\VehicleBuilder;

class VehicleController extends AbstractFOSRestController
{
    /**
     * @var VehicleBuilder
     */
    private $vehicleBuilder;

    public function __construct(VehicleBuilder $vehicleBuilder)
    {
        $this->vehicleBuilder = $vehicleBuilder;
    }

    /**
     * @Rest\Get("/manufacturer")
     */
    public function manufacturerAction(): View
    {
        $manufacturers = $this->vehicleBuilder->getManufacturers();

        return $this->view($manufacturers);
    }

    /**
     * @Rest\Get("/manufacturer/{manufacturerId}/model")
     */
    public function manufacturerModelAction(int $manufacturerId): View
    {
        $models = $this->vehicleBuilder->getVehicleModels($manufacturerId);

        return $this->view($models);
    }

    /**
     * @Rest\Get("/vehicle/model/{modelId}/type")
     */
    public function vehicleModelTypeAction(int $modelId): View
    {
        $vehicles = $this->vehicleBuilder->getVehicleTypes($modelId);

        return $this->view($vehicles);
    }

    /**
     * @Rest\Get("/vehicle/kba/{kba}")
     */
    public function vehicleByKbaAction(string $kba): View
    {
        $vehicles = $this->vehicleBuilder->getVehiclesByKba($kba);

        return $this->view($vehicles);
    }

    /**
     * @Rest\Get("/vehicle/{vehicleId}")
     */
    public function vehicleAction(int $vehicleId): View
    {
        $vehicle = $this->vehicleBuilder->getVehicle($vehicleId);

        if (!$vehicle) {
            throw $this->createNotFoundException('Vehicle not found');
        }

        return $this->view($vehicle);
    }
}
