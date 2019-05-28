<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc200Article;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Entity repository for Article
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleRepository extends TranslateEntityRepository
{
    /**
     * Find articles by datasupplier
     * @param int $dlnr
     * @param int $page
     * @param $limit
     * @return Pagerfanta
     */
    public function findByDatasupplierPager(int $dlnr, int $page, $limit): Pagerfanta
    {
        $dql = 'SELECT article
                FROM Gweb\TecdocBundle\Entity\Tecdoc200Article article
                WHERE article.dlnr = :dlnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr);

        $pagerAdapter = new DoctrineORMAdapter($query, false);

        $pagerfanta = new Pagerfanta($pagerAdapter);
        $pagerfanta->setCurrentPage($page);
        $pagerfanta->setMaxPerPage($limit);

        return $pagerfanta;
    }

    /**
     * Find article
     * @param int $dlnr
     * @param string $artnr
     * @return Tecdoc200Article|null
     */
    public function findByArticle(int $dlnr, string $artnr): ?Tecdoc200Article
    {
        $dql = 'SELECT article,
                       description
                FROM Gweb\TecdocBundle\Entity\Tecdoc200Article article
                LEFT JOIN article.description description WITH description.sprachnr = :sprachnr
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr);
        $query->setParameter('artnr', $artnr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getOneOrNullResult();
    }
}
