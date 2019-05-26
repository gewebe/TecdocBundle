<?php

namespace Gweb\TecdocBundle\Api\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use Swagger\Annotations as SWG;

/**
 * @Hateoas\Relation(
 *     "vehicleModel",
 *     href=@Hateoas\Route(
 *         "manufacturer_model",
 *         parameters={"manufacturerId"= "expr(object.getId())"}
 *     )
 * )
 */
class Manufacturer
{
    /**
     * @var int
     * @SWG\Property(type="integer", example=5)
     */
    private $id;

    /**
     * @var string
     * @SWG\Property(type="string", example="AUDI")
     */
    private $name;

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
}
