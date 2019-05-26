<?php

namespace Gweb\TecdocBundle\Api\Model;

use Hateoas\Configuration\Annotation as Hateoas;
use Swagger\Annotations as SWG;

/**
 * @Hateoas\Relation(
 *     "article",
 *     href=@Hateoas\Route(
 *         "article_by_supplier",
 *         parameters={"supplierId"= "expr(object.getId())"}
 *     )
 * )
 */
class Supplier
{
    /**
     * @var int
     * @SWG\Property(type="integer", example=3)
     */
    private $id;

    /**
     * @var string
     * @SWG\Property(type="string", example="ATE")
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
