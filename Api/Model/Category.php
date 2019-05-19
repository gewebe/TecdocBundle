<?php

namespace Gweb\TecdocBundle\Api\Model;

class Category
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
     * @var Category[]
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
