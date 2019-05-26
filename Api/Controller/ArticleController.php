<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\ArticleBuilder;
use Gweb\TecdocBundle\Api\Model\Article;
use Gweb\TecdocBundle\Api\Model\ArticleGeneric;
use Gweb\TecdocBundle\Api\Model\ArticleCriteria;
use Gweb\TecdocBundle\Api\Model\ArticleText;
use Gweb\TecdocBundle\Api\Model\ArticleReference;
use Gweb\TecdocBundle\Api\Model\ArticleVehicle;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class ArticleController extends AbstractFOSRestController
{
    /**
     * @var ArticleBuilder
     */
    private $articleBuilder;

    /**
     * @param ArticleBuilder $articleBuilder
     */
    public function __construct(
        ArticleBuilder $articleBuilder
    ) {
        $this->articleBuilder = $articleBuilder;
    }

    /**
     * @Rest\Get("/article/{supplierId}")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find articles by supplier id",
     *   @SWG\Response(
     *     response=200,
     *     description="Article list",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"list"}))
     *     )
     *   )
     * )
     */
    public function articleBySupplierAction(int $supplierId): View
    {
        $articles = $this->articleBuilder->getArticles($supplierId);

        return $this->view($articles);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article with all details by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="Article details",
     *     @Model(type=Article::class)
     *   ),
     *   @SWG\Response(
     *     response=404,
     *     description="Article not found"
     *   )
     * )
     */
    public function articleAction(int $supplierId, string $articleId): View
    {
        $article = $this->articleBuilder->getArticle($supplierId, $articleId);

        if (!$article) {
            throw $this->createNotFoundException('Article not found');
        }

        $this->articleBuilder->buildDocument($article);

        return $this->view($article);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/criteria")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article criteria by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleCriteria::class))
     *     )
     *   )
     * )
     */
    public function articleCriteriaAction(int $supplierId, string $articleId): View
    {
        $articleCriteria = $this->articleBuilder->getCriterias($supplierId, $articleId);

        return $this->view($articleCriteria);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/image")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article image by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     *   )
     * )
     */
    public function articleImageAction(int $supplierId, string $articleId): View
    {
        $articleImage = $this->articleBuilder->getImages($supplierId, $articleId);

        return $this->view($articleImage);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/text")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article text by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleText::class))
     *     )
     *   )
     * )
     */
    public function articleTextAction(int $supplierId, string $articleId): View
    {
        $articleText = $this->articleBuilder->getTexts($supplierId, $articleId);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/number/ean")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article ean by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     *   )
     * )
     */
    public function articleEanAction(int $supplierId, string $articleId): View
    {
        $ean = $this->articleBuilder->getEan($supplierId, $articleId);

        return $this->view($ean);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/number/reference")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article reference numbers by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleReference::class))
     *     )
     *   )
     * )
     */
    public function articleReferenceAction(int $supplierId, string $articleId): View
    {
        $referenceNumbers = $this->articleBuilder->getReferenceNumbers($supplierId, $articleId);

        return $this->view($referenceNumbers);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/number/supersede")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article supersede number by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     *   )
     * )
     */
    public function articleSupersedeAction(int $supplierId, string $articleId): View
    {
        $supersedeNumbers = $this->articleBuilder->getSupersedeNumbers($supplierId, $articleId);

        return $this->view($supersedeNumbers);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/number/trade")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article trade number by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     *   )
     * )
     */
    public function articleTradeAction(int $supplierId, string $articleId): View
    {
        $tradeNumbers = $this->articleBuilder->getTradeNumbers($supplierId, $articleId);

        return $this->view($tradeNumbers);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find generic articles by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleGeneric::class, groups={"list"}))
     *     )
     *   )
     * )
     */
    public function articleGenericAction(int $supplierId, string $articleId): View
    {
        $articleGeneric = $this->articleBuilder->getGenericArticles($supplierId, $articleId);

        return $this->view($articleGeneric);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericId}/vehicle")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article vehicle by supplier-id, article-id and generic-article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleVehicle::class))
     *     )
     *   )
     * )
     */
    public function articleVehicleAction(int $supplierId, string $articleId, int $genericId): View
    {
        $articleVehicle = $this->articleBuilder->getVehicles(
            $supplierId,
            $articleId,
            $genericId
        );

        return $this->view($articleVehicle);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericId}/vehicle/{vehicleId}/criteria")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article vehicle criteria by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleCriteria::class))
     *     )
     *   )
     * )
     */
    public function articleVehicleCriteriaAction(
        int $supplierId,
        string $articleId,
        int $genericId,
        int $vehicleId
    ): View {
        $articleVehicleCriterias = $this->articleBuilder->getVehicleCriterias(
            $supplierId,
            $articleId,
            $genericId,
            $vehicleId
        );

        return $this->view($articleVehicleCriterias);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericId}/vehicle/{vehicleId}/image")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article vehicle image by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(type="string")
     *     )
     *   )
     * )
     */
    public function articleVehicleImageAction(
        int $supplierId,
        string $articleId,
        int $genericId,
        int $vehicleId
    ): View {
        $articleVehicleImages = $this->articleBuilder->getVehicleImages(
            $supplierId,
            $articleId,
            $genericId,
            $vehicleId
        );

        return $this->view($articleVehicleImages);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericId}/vehicle/{vehicleId}/text")
     *
     * @SWG\Get(
     *   tags={"Article"},
     *   description="Find article vehicle text by supplier-id and article-id",
     *   @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=ArticleText::class))
     *     )
     *   )
     * )
     */
    public function articleVehicleTextAction(
        int $supplierId,
        string $articleId,
        int $genericId,
        int $vehicleId
    ): View {
        $articleVehicle = $this->articleBuilder->getVehicleTexts(
            $supplierId,
            $articleId,
            $genericId,
            $vehicleId
        );

        return $this->view($articleVehicle);
    }
}
