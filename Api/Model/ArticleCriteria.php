<?php

namespace Gweb\TecdocBundle\Api\Model;

use Swagger\Annotations as SWG;

class ArticleCriteria
{
    /**
     * @var string
     * @SWG\Property(type="string", example="Length [mm]")
     */
    private $name;

    /**
     * @var string
     * @SWG\Property(type="string", example="746")
     */
    private $value;

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
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
