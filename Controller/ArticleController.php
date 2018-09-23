<?php

namespace Gweb\TecdocBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Gweb\TecdocBundle\Entity\Tecdoc200Article;
use Gweb\TecdocBundle\Entity\Tecdoc210ArticleCriteria;
use Gweb\TecdocBundle\Entity\Tecdoc211ArticleGenericArticle;
use Gweb\TecdocBundle\Entity\Tecdoc232ArticleImage;
use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;

/**
 * Tecdoc Article API
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleController extends FOSRestController
{
    /**
     * @Rest\Get("/article/{lang}/{dlnr}")
     */
    public function articleSupplierAction(int $dlnr): View
    {
        $repository = $this->getRepository(Tecdoc200Article::class);
        $articles = $repository->findByDlnr($dlnr, ['artnr' => 'ASC'], 1000);

        return $this->view($articles);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}")
     */
    public function articleAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc200Article::class);
        $article = $repository->findOneBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr,
        ]);

        return $this->view($article);
    }

    /**
     * @Rest\Get("/article/generic/{lang}/{dlnr}/{artnr}")
     */
    public function articleGenericAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc211ArticleGenericArticle::class);
        $articleGeneric = $repository->findBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr,
        ]);

        return $this->view($articleGeneric);
    }

    /**
     * @Rest\Get("/article/criteria/{lang}/{dlnr}/{artnr}")
     */
    public function articleCriteriaAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc210ArticleCriteria::class);
        $articleCriteria = $repository->findBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr,
        ]);

        return $this->view($articleCriteria);
    }

    /**
     * @Rest\Get("/article/image/{lang}/{dlnr}/{artnr}")
     */
    public function articleImageAction(int $dlnr, string $artnr): View
    {
        $repository = $this->getRepository(Tecdoc232ArticleImage::class);
        $articleImage = $repository->findBy([
            'dlnr' => $dlnr,
            'artnr' => $artnr,
        ]);

        return $this->view($articleImage);
    }

    /**
     * @Rest\Get("/article/car/{lang}/{dlnr}/{artnr}/{genartnr}")
     */
    public function articleVehicleAction(int $dlnr, string $artnr, int $genartnr): View
    {
        $repository = $this->getRepository(Tecdoc400ArticleLinkage::class);
        $articleVehicle = $repository->findByArticle($dlnr, $artnr, $genartnr, 2);

        return $this->view($articleVehicle);
    }

    /**
     * get tecdoc entity manager
     * @param string $className
     * @return ObjectRepository
     */
    private function getRepository(string $className): ObjectRepository
    {
        return $this->get('gweb_tecdoc.entity_manager')->getRepository($className);
    }
}
