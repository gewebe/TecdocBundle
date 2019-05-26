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
 *         "article",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "generic",
 *     href=@Hateoas\Route(
 *         "article_generic",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "criteria",
 *     href=@Hateoas\Route(
 *         "article_criteria",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "image",
 *     href=@Hateoas\Route(
 *         "article_image",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "text",
 *     href=@Hateoas\Route(
 *         "article_text",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "ean",
 *     href=@Hateoas\Route(
 *         "article_ean",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "reference",
 *     href=@Hateoas\Route(
 *         "article_reference",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "supersede",
 *     href=@Hateoas\Route(
 *         "article_supersede",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 * @Hateoas\Relation(
 *     "trade",
 *     href=@Hateoas\Route(
 *         "article_trade",
 *         parameters={"supplierId"= "expr(object.getSupplierId())", "articleId"= "expr(object.getArticleId())"}
 *     )
 * )
 */
class Article
{
    /**
     * @var int
     * @JMS\Groups({"list"})
     * @SWG\Property(type="integer", example=1)
     */
    private $supplierId;

    /**
     * @var string
     * @JMS\Groups({"list"})
     * @SWG\Property(type="string", example="22322")
     */
    private $articleId;

    /**
     * @var string
     * @SWG\Property(type="string", example="4019064023227")
     */
    private $ean;

    /**
     * @var ArticleReference[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleReference::class)))
     */
    private $referenceNumbers;

    /**
     * @var array
     * @SWG\Property(type="array", @SWG\Items(type="string"))
     */
    private $supersedeNumbers;

    /**
     * @var array
     * @SWG\Property(type="array", @SWG\Items(type="string"))
     */
    private $tradeNumbers;

    /**
     * @var ArticleGeneric[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleGeneric::class)))
     */
    private $genericArticles;

    /**
     * @var ArticleCriteria[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleCriteria::class)))
     */
    private $criterias;

    /**
     * @var array
     * @SWG\Property(type="array", @SWG\Items(type="string"))
     */
    private $images;

    /**
     * @var ArticleText[]
     * @SWG\Property(type="array", @SWG\Items(ref=@Model(type=ArticleText::class)))
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
