<?php

namespace Gweb\TecdocBundle\Api\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as JMS;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @Hateoas\Relation(
 *     "self",
 *     href=@Hateoas\Route(
 *         "vehicle",
 *         parameters={"vehicleId"= "expr(object.getId())"}
 *     )
 * )
 */
class Vehicle
{
    /**
     * @var int
     * @JMS\Groups({"list"})
     * @SWG\Property(type="integer", example=1442)
     */
    private $id;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="2.0 E 16V")
     */
    private $name;

    /**
     * @var int
     * @JMS\Groups({"list"})
     * @SWG\Property(type="integer", example=140)
     */
    private $horsePower;

    /**
     * @var string|null
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="1993-01")
     */
    private $buildFrom;

    /**
     * @var string|null
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="1995-12")
     */
    private $buildUntil;

    /**
     * @var Manufacturer
     * @SWG\Property(ref=@Model(type=Manufacturer::class))
     */
    private $manufacturer;

    /**
     * @var VehicleModel
     * @SWG\Property(ref=@Model(type=VehicleModel::class))
     */
    private $vehicleModel;

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
}
