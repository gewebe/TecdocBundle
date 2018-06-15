<?php

namespace Gweb\TecdocBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Gweb\TecdocBundle\Entity\Tecdoc200Article;
use Gweb\TecdocBundle\Entity\Tecdoc210ArticleCriteria;
use Gweb\TecdocBundle\Entity\Tecdoc211ArticleGenericArticle;
use Gweb\TecdocBundle\Entity\Tecdoc232ArticleImage;
use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;
use Gweb\TecdocBundle\Service\EntityManager;

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
    public function articleSupplierAction(int $dlnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc200Article::class)->findByDlnr($dlnr, ['artnr' => 'ASC'], 10000);
    }

    /**
     * @Rest\Get("/article/{lang}/{dlnr}/{artnr}")
     */
    public function articleAction(int $dlnr, string $artnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc200Article::class)->findOneBy(
          [
            'dlnr' => $dlnr,
            'artnr' => $artnr,
          ]
        );
    }

    /**
     * @Rest\Get("/article/generic/{lang}/{dlnr}/{artnr}")
     */
    public function articleGenericAction(int $dlnr, string $artnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc211ArticleGenericArticle::class)->findBy(
          [
            'dlnr' => $dlnr,
            'artnr' => $artnr,
          ]
        );
    }

    /**
     * @Rest\Get("/article/criteria/{lang}/{dlnr}/{artnr}")
     */
    public function articleCriteriaAction(int $dlnr, string $artnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc210ArticleCriteria::class)->findBy(
          [
            'dlnr' => $dlnr,
            'artnr' => $artnr,
          ]
        );
    }

    /**
     * @Rest\Get("/article/image/{lang}/{dlnr}/{artnr}")
     */
    public function articleImageAction(int $dlnr, string $artnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc232ArticleImage::class)->findBy(
          [
            'dlnr' => $dlnr,
            'artnr' => $artnr,
          ]
        );
    }


    /**
     * @Rest\Get("/article/car/{lang}/{dlnr}/{artnr}/{genartnr}")
     */
    public function articleVehicleAction(int $dlnr, string $artnr, int $genartnr)
    {
        return $this->getEntityManager()->getRepository(Tecdoc400ArticleLinkage::class)->findByArticle($dlnr, $artnr, $genartnr, 2);
    }

    /**
     * get tecdoc entity manager
     * @return EntityManager
     */
    private function getEntityManager(): EntityManager
    {
        return $this->container->get('gweb_tecdoc.entity_manager');
    }

}
