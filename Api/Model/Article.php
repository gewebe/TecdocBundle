<?php

namespace Gweb\TecdocBundle\Api\Model;

class Article
{
    /**
     * @var int
     */
    private $supplierId;

    /**
     * @var string
     */
    private $articleId;

    /**
     * @var string
     */
    private $ean;

    /**
     * @var array
     */
    private $referenceNumbers;

    /**
     * @var array
     */
    private $supersedeNumbers;

    /**
     * @var array
     */
    private $tradeNumbers;

    /**
     * @var ArticleGeneric[]
     */
    private $genericArticles;

    /**
     * @var array
     */
    private $criterias;

    /**
     * @var array
     */
    private $images;

    /**
     * @var array
     */
    private $texts;

    /**
     * @return int
     */
    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    /**
     * @param int $supplierId
     */
    public function setSupplierId(int $supplierId): void
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return string
     */
    public function getArticleId(): string
    {
        return $this->articleId;
    }

    /**
     * @param string $articleId
     */
    public function setArticleId(string $articleId): void
    {
        $this->articleId = $articleId;
    }

    /**
     * @return string
     */
    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     */
    public function setEan(string $ean): void
    {
        $this->ean = $ean;
    }

    /**
     * @return array
     */
    public function getReferenceNumbers(): array
    {
        return $this->referenceNumbers;
    }

    /**
     * @param array $referenceNumbers
     */
    public function setReferenceNumbers(array $referenceNumbers): void
    {
        $this->referenceNumbers = $referenceNumbers;
    }

    /**
     * @return array
     */
    public function getSupersedeNumbers(): array
    {
        return $this->supersedeNumbers;
    }

    /**
     * @param array $supersedeNumbers
     */
    public function setSupersedeNumbers(array $supersedeNumbers): void
    {
        $this->supersedeNumbers = $supersedeNumbers;
    }

    /**
     * @return array
     */
    public function getTradeNumbers(): array
    {
        return $this->tradeNumbers;
    }

    /**
     * @param array $tradeNumbers
     */
    public function setTradeNumbers(array $tradeNumbers): void
    {
        $this->tradeNumbers = $tradeNumbers;
    }

    /**
     * @return ArticleGeneric[]
     */
    public function getGenericArticles(): array
    {
        return $this->genericArticles;
    }

    /**
     * @param ArticleGeneric[] $genericArticles
     */
    public function setGenericArticles(array $genericArticles): void
    {
        $this->genericArticles = $genericArticles;
    }

    /**
     * @return array
     */
    public function getCriterias(): array
    {
        return $this->criterias;
    }

    /**
     * @param array $criterias
     */
    public function setCriterias(array $criterias): void
    {
        $this->criterias = $criterias;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * @return array
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    /**
     * @param array $texts
     */
    public function setTexts(array $texts): void
    {
        $this->texts = $texts;
    }
}
