<?php

namespace Gweb\TecdocBundle\Api\Model;

class Vehicle
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Manufacturer
     */
    private $manufacturer;

    /**
     * @var VehicleModel
     */
    private $vehicleModel;

    /**
     * @var int
     */
    private $horsePower;

    /**
     * @var string|null
     */
    private $buildFrom;

    /**
     * @var string|null
     */
    private $buildUntil;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function setManufacturer(Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return VehicleModel
     */
    public function getVehicleModel(): VehicleModel
    {
        return $this->vehicleModel;
    }

    /**
     * @param VehicleModel $vehicleModel
     */
    public function setVehicleModel(VehicleModel $vehicleModel): void
    {
        $this->vehicleModel = $vehicleModel;
    }

    /**
     * @return int
     */
    public function getHorsePower(): int
    {
        return $this->horsePower;
    }

    /**
     * @param int $horsePower
     */
    public function setHorsePower(int $horsePower): void
    {
        $this->horsePower = $horsePower;
    }

    /**
     * @return string|null
     */
    public function getBuildFrom(): ?string
    {
        return $this->buildFrom;
    }

    /**
     * @param string|null $buildFrom
     */
    public function setBuildFrom(?string $buildFrom): void
    {
        $this->buildFrom = $buildFrom;
    }

    /**
     * @return string|null
     */
    public function getBuildUntil(): ?string
    {
        return $this->buildUntil;
    }

    /**
     * @param string|null $buildUntil
     */
    public function setBuildUntil(?string $buildUntil): void
    {
        $this->buildUntil = $buildUntil;
    }
}
