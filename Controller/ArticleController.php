<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc200Article;
use Gweb\TecdocBundle\Entity\Tecdoc203ArticleReferenceNumber;
use Gweb\TecdocBundle\Entity\Tecdoc204ArticleSupersedeNumber;
use Gweb\TecdocBundle\Entity\Tecdoc206ArticleText;
use Gweb\TecdocBundle\Entity\Tecdoc207ArticleTradeNumber;
use Gweb\TecdocBundle\Entity\Tecdoc209ArticleEAN;
use Gweb\TecdocBundle\Entity\Tecdoc210ArticleCriteria;
use Gweb\TecdocBundle\Entity\Tecdoc211ArticleGenericArticle;
use Gweb\TecdocBundle\Entity\Tecdoc232ArticleImage;
use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;

/**
 * Tecdoc Article API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleController extends ApiController
{
    /**
     * @Rest\Get("/article/{lang}/{dlnr}")
     */
    public function articleSupplierAction(int $dlnr): View
    {
        $repository = $this->getRepository(Tecdoc200Article::class);
        $articles = $repository->findByDatasupplier($dlnr);

        return $this->view($articles);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}")
     */
    public function articleAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc200Article::class);
        $article = $repository->findByArticle($dlnr, $artnr);

        return $this->view($article);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/generic")
     */
    public function articleGenericAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc211ArticleGenericArticle::class);
        $articleGeneric = $repository->findByArticle($dlnr, $artnr);

        return $this->view($articleGeneric);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/criteria")
     */
    public function articleCriteriaAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc210ArticleCriteria::class);
        $articleCriteria = $repository->findByArticle($dlnr, $artnr);

        return $this->view($articleCriteria);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/image")
     */
    public function articleImageAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc232ArticleImage::class);
        $articleImage = $repository->findByArticle($dlnr, $artnr);

        return $this->view($articleImage);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/text")
     */
    public function articleTextAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc206ArticleText::class);
        $articleText = $repository->findByArticle($dlnr, $artnr);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/ean")
     */
    public function articleEanAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc209ArticleEAN::class);
        $articleText = $repository->findBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr
        ]);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/reference")
     */
    public function articleReferenceAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc203ArticleReferenceNumber::class);
        $articleText = $repository->findByArticle($dlnr, $artnr);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/supersede")
     */
    public function articleSupersedeAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc204ArticleSupersedeNumber::class);
        $articleText = $repository->findBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr
        ]);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/trade")
     */
    public function articleTradeAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc207ArticleTradeNumber::class);
        $articleText = $repository->findBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr
        ]);

        return $this->view($articleText);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}/{genartnr}/car")
     */
    public function articleVehicleAction(int $dlnr, string $artnr, int $genartnr): View
    {
        $repository = $this->getRepository(Tecdoc400ArticleLinkage::class);
        $articleVehicle = $repository->findByArticle($dlnr, $artnr, $genartnr, 2);

        return $this->view($articleVehicle);
    }
}
