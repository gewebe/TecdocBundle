<?php

namespace Gweb\TecdocBundle\Api\Model;

class ArticleText
{
    /**
     * @var bool
     */
    private $immediately;

    /**
     * @var string
     */
    private $text;

    /**
     * @return bool
     */
    public function isImmediately(): bool
    {
        return $this->immediately;
    }

    /**
     * @param bool $immediately
     */
    public function setImmediately(bool $immediately): void
    {
        $this->immediately = $immediately;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
