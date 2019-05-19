<?php

namespace Gweb\TecdocBundle\Api\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Api\Builder\ArticleBuilder;

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
     */
    public function articleBySupplierAction(int $supplierId): View
    {
        $articles = $this->articleBuilder->getArticles($supplierId);

        return $this->view($articles);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}")
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
     * @Rest\Get("/article/{supplierId}/{articleId}/generic")
     */
    public function articleGenericAction(int $supplierId, string $articleId): View
    {
        $articleGeneric = $this->articleBuilder->getGenericArticles($supplierId, $articleId);

        return $this->view($articleGeneric);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/criteria")
     */
    public function articleCriteriaAction(int $supplierId, string $articleId): View
    {
        $articleCriteria = $this->articleBuilder->getCriterias($supplierId, $articleId);

        return $this->view($articleCriteria);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/image")
     */
    public function articleImageAction(int $supplierId, string $articleId): View
    {
        $articleImage = $this->articleBuilder->getImages($supplierId, $articleId);

        return $this->view($articleImage);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/text")
     */
    public function articleTextAction(int $supplierId, string $articleId): View
    {
        $articleText = $this->articleBuilder->getTexts($supplierId, $articleId);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/ean")
     */
    public function articleEanAction(int $supplierId, string $articleId): View
    {
        $ean = $this->articleBuilder->getEan($supplierId, $articleId);

        return $this->view($ean);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/reference")
     */
    public function articleReferenceAction(int $supplierId, string $articleId): View
    {
        $referenceNumbers = $this->articleBuilder->getReferenceNumbers($supplierId, $articleId);

        return $this->view($referenceNumbers);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/supersede")
     */
    public function articleSupersedeAction(int $supplierId, string $articleId): View
    {
        $supersedeNumbers = $this->articleBuilder->getSupersedeNumbers($supplierId, $articleId);

        return $this->view($supersedeNumbers);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/trade")
     */
    public function articleTradeAction(int $supplierId, string $articleId): View
    {
        $tradeNumbers = $this->articleBuilder->getTradeNumbers($supplierId, $articleId);

        return $this->view($tradeNumbers);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericArticleId}/vehicle")
     */
    public function articleVehicleAction(int $supplierId, string $articleId, int $genericArticleId): View
    {
        $articleVehicle = $this->articleBuilder->getVehicles(
            $supplierId,
            $articleId,
            $genericArticleId
        );

        return $this->view($articleVehicle);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericArticleId}/vehicle/{vehicleId}/criteria")
     */
    public function articleVehicleCriteriaAction(
        int $supplierId,
        string $articleId,
        int $genericArticleId,
        int $vehicleId
    ): View {
        $articleVehicleCriterias = $this->articleBuilder->getVehicleCriterias(
            $supplierId,
            $articleId,
            $genericArticleId,
            $vehicleId
        );

        return $this->view($articleVehicleCriterias);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericArticleId}/vehicle/{vehicleId}/image")
     */
    public function articleVehicleImageAction(
        int $supplierId,
        string $articleId,
        int $genericArticleId,
        int $vehicleId
    ): View {
        $articleVehicleImages = $this->articleBuilder->getVehicleImages(
            $supplierId,
            $articleId,
            $genericArticleId,
            $vehicleId
        );

        return $this->view($articleVehicleImages);
    }

    /**
     * @Rest\Get("/article/{supplierId}/{articleId}/generic/{genericArticleId}/vehicle/{vehicleId}/text")
     */
    public function articleVehicleTextAction(
        int $supplierId,
        string $articleId,
        int $genericArticleId,
        int $vehicleId
    ): View {
        $articleVehicle = $this->articleBuilder->getVehicleTexts(
            $supplierId,
            $articleId,
            $genericArticleId,
            $vehicleId
        );

        return $this->view($articleVehicle);
    }
}
