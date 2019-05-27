<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\VehicleBuilder;
use Gweb\TecdocBundle\Api\Model\Manufacturer;
use Gweb\TecdocBundle\Api\Model\VehicleModel;
use Gweb\TecdocBundle\Api\Model\Vehicle;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

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
     * @Rest\Get("/vehicle/manufacturer")
     *
     * @SWG\Get(
     *   tags={"Vehicle"},
     *   description="Find vehicle manufacturers",
     *   @SWG\Response(
     *     response=200,
     *     description="Vehicle Manufacturers",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Manufacturer::class))
     *     )
     *   )
     * )
     */
    public function manufacturerAction(): View
    {
        $manufacturers = $this->vehicleBuilder->getVehicleManufacturers();

        return $this->view($manufacturers);
    }

    /**
     * @Rest\Get("/vehicle/model")
     * @Rest\QueryParam(name="manufacturerId", requirements="\d+", default="1", description="Manufacturer-ID (HerNr)")
     *
     * @SWG\Get(
     *   tags={"Vehicle"},
     *   description="Find vehicle models",
     *   @SWG\Response(
     *     response=200,
     *     description="Vehicle Models",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=VehicleModel::class))
     *     )
     *   )
     * )
     */
    public function manufacturerModelAction(ParamFetcherInterface $paramFetcher): View
    {
        $manufacturerId = $paramFetcher->get('manufacturerId');

        $models = $this->vehicleBuilder->getVehicleModels($manufacturerId);

        return $this->view($models);
    }

    /**
     * @Rest\Get("/vehicle")
     * @Rest\QueryParam(name="modelId", requirements="\d+", default="1", description="Model-ID (KModNr)")
     *
     * @SWG\Get(
     *   tags={"Vehicle"},
     *   description="Find vehicles by model",
     *   @SWG\Response(
     *     response=200,
     *     description="Vehicles",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Vehicle::class, groups={"list"}))
     *     )
     *   )
     * )
     */
    public function vehicleModelTypeAction(ParamFetcherInterface $paramFetcher): View
    {
        $modelId = $paramFetcher->get('modelId');

        $vehicles = $this->vehicleBuilder->getVehicleTypes($modelId);

        return $this->view($vehicles);
    }

    /**
     * @Rest\Get("/vehicle/kba/{kba}")
     *
     * @SWG\Get(
     *   tags={"Vehicle"},
     *   description="Find vehicles by kba",
     *   @SWG\Response(
     *     response=200,
     *     description="Vehicles",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Vehicle::class))
     *     )
     *   )
     * )
     * @SWG\Parameter(
     *   name="kba",
     *   description="German KBA number",
     *   type="string",
     *   in="path",
     *   default="0039911",
     *   required=true
     * )
     */
    public function vehicleByKbaAction(string $kba): View
    {
        $vehicles = $this->vehicleBuilder->getVehiclesByKba($kba);

        return $this->view($vehicles);
    }

    /**
     * @Rest\Get("/vehicle/{vehicleId}")
     *
     * @SWG\Get(
     *   tags={"Vehicle"},
     *   description="Find vehicle",
     *   @SWG\Response(
     *     response=200,
     *     description="Vehicle",
     *     @Model(type=Vehicle::class)
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Vehicle not found"
     *   )
     * )
     * @SWG\Parameter(
     *   name="vehicleId",
     *   description="Vehicle-ID (KTypNr)",
     *   type="integer",
     *   in="path",
     *   required=true
     * )
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
