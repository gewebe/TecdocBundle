<?php

namespace Gweb\TecdocBundle\Api\Builder;

use Gweb\TecdocBundle\Api\Model\Manufacturer;
use Gweb\TecdocBundle\Api\Model\Vehicle;
use Gweb\TecdocBundle\Api\Model\VehicleModel;
use Gweb\TecdocBundle\Entity\Tecdoc100Manufacturer;
use Gweb\TecdocBundle\Entity\Tecdoc110VehicleModel;
use Gweb\TecdocBundle\Entity\Tecdoc120VehicleType;
use Gweb\TecdocBundle\Entity\Tecdoc121VehicleTypeKba;

class VehicleBuilder extends ApiBuilder
{
    /**
     * @return Manufacturer[]
     */
    public function getManufacturers(): array
    {
        $repository = $this->getRepository(Tecdoc100Manufacturer::class);
        $totalManufacturers = $repository->findAll();

        $manufacturers = [];

        foreach ($totalManufacturers as $totalManufacturer) {
            $manufacturer = new Manufacturer();
            $manufacturer->setId($totalManufacturer->getHernr());
            $manufacturer->setName($totalManufacturer->getDescription()->getBez());

            $manufacturers[] = $manufacturer;
        }

        return $manufacturers;
    }

    /**
     * @param int $manufacturerId
     * @return VehicleModel[]
     */
    public function getVehicleModels(int $manufacturerId): array
    {
        $repository = $this->getRepository(Tecdoc110VehicleModel::class);
        $vehicleModels = $repository->findByManufacturer($manufacturerId);

        $models = [];

        /**
         * @var Tecdoc110VehicleModel $vehicleModel
         */
        foreach ($vehicleModels as $vehicleModel) {
            $model = new VehicleModel();
            $model->setId($vehicleModel->getKmodNr());
            $model->setName($vehicleModel->getDescription()->getBez());
            if ($vehicleModel->getBjvon()) {
                $model->setBuildFrom($vehicleModel->getBjvon()->format('Y-m'));
            }
            if ($vehicleModel->getBjbis()) {
                $model->setBuildUntil($vehicleModel->getBjbis()->format('Y-m'));
            }

            $models[] = $model;
        }

        return $models;
    }

    /**
     * @param int $modelId
     * @return Vehicle[]
     */
    public function getVehicleTypes(int $modelId): array
    {
        $repository = $this->getRepository(Tecdoc120VehicleType::class);
        $vehicleTypes = $repository->findByVehicleModel($modelId);

        $vehicles = [];

        foreach ($vehicleTypes as $vehicleType) {
            $vehicle = new Vehicle();
            $vehicle->setId($vehicleType->getKtypnr());
            $vehicle->setName($vehicleType->getDescription()->getBez());
            $vehicle->setHorsePower($vehicleType->getPs());
            if ($vehicleType->getBjvon()) {
                $vehicle->setBuildFrom($vehicleType->getBjvon()->format('Y-m'));
            }
            if ($vehicleType->getBjbis()) {
                $vehicle->setBuildUntil($vehicleType->getBjbis()->format('Y-m'));
            }

            $vehicles[] = $vehicle;
        }

        return $vehicles;
    }

    /**
     * @param string $kba
     * @return Vehicle[]
     */
    public function getVehiclesByKba(string $kba): array
    {
        $repository = $this->getRepository(Tecdoc121VehicleTypeKba::class);
        $vehicleKbas = $repository->findByKba($kba);

        $vehicles = [];
        foreach ($vehicleKbas as $vehicleKba) {
            $vehicles[] = self::buildVehicle($vehicleKba->getVehicleType());
        }

        return $vehicles;
    }

    /**
     * @param int $vehicleId
     * @return Vehicle|null
     */
    public function getVehicle(int $vehicleId): ?Vehicle
    {
        $repository = $this->getRepository(Tecdoc120VehicleType::class);
        $vehicleType = $repository->findVehicle($vehicleId);

        if (!$vehicleType) {
            return null;
        }

        return self::buildVehicle($vehicleType);
    }

    /**
     * @param Tecdoc120VehicleType $vehicleType
     * @return Vehicle
     */
    public static function buildVehicle(Tecdoc120VehicleType $vehicleType): Vehicle
    {
        $vehicle = new Vehicle();
        $vehicle->setId($vehicleType->getKtypnr());
        $vehicle->setName($vehicleType->getDescription()->getBez());
        $vehicle->setHorsePower($vehicleType->getPs());
        if ($vehicleType->getBjvon()) {
            $vehicle->setBuildFrom($vehicleType->getBjvon()->format('Y-m'));
        }
        if ($vehicleType->getBjbis()) {
            $vehicle->setBuildUntil($vehicleType->getBjbis()->format('Y-m'));
        }

        $manufacturer = new Manufacturer();
        $manufacturer->setId($vehicleType->getVehicleModel()->getManufacturer()->getHernr());
        $manufacturer->setName($vehicleType->getVehicleModel()->getManufacturer()->getDescription()->getBez());
        $vehicle->setManufacturer($manufacturer);

        $vehicleModel = new VehicleModel();
        $vehicleModel->setId($vehicleType->getVehicleModel()->getKmodnr());
        $vehicleModel->setName($vehicleType->getVehicleModel()->getDescription()->getBez());
        $vehicle->setVehicleModel($vehicleModel);

        return $vehicle;
    }
}
