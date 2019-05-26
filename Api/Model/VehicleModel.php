<?php

namespace Gweb\TecdocBundle\Api\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use Swagger\Annotations as SWG;

/**
 * @Hateoas\Relation(
 *     "vehicle",
 *     href=@Hateoas\Route(
 *         "vehicle_model_type",
 *         parameters={"modelId"= "expr(object.getId())"}
 *     )
 * )
 */
class VehicleModel
{
    /**
     * @var int
     * @SWG\Property(type="integer", example=6)
     */
    private $id;

    /**
     * @var string
     * @SWG\Property(type="string", example="80 Avant (8C, B4)")
     */
    private $name;

    /**
     * @var string|null
     * @SWG\Property(type="string", example="1991-08")
     */
    private $buildFrom;

    /**
     * @var string|null
     * @SWG\Property(type="string", example="1995-12")
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
