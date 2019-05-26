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
 *         "category",
 *         parameters={"categoryId"= "expr(object.getId())"}
 *     )
 * )
 */
class Category
{
    /**
     * @var int
     * @JMS\Groups({"list"})
     * @SWG\Property(type="integer", example=100025)
     */
    private $id;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="Motor")
     */
    private $name;

    /**
     * @var Category[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=Category::class)))
     */
    private $childs;

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
     * @return Category[]
     */
    public function getChilds(): array
    {
        return $this->childs;
    }

    /**
     * @param Category[] $childs
     */
    public function setChilds(array $childs): void
    {
        $this->childs = $childs;
    }

    /**
     * @param Category $category
     */
    public function addChild(Category $category): void
    {
        $this->childs[] = $category;
    }
}
