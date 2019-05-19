<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc200Article;

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
     * @return Tecdoc200Article[]
     */
    public function findByDatasupplier(int $dlnr): array
    {
        $dql = 'SELECT article,
                       description
                FROM Gweb\TecdocBundle\Entity\Tecdoc200Article article
                LEFT JOIN article.description description WITH description.sprachnr = :sprachnr
                WHERE article.dlnr = :dlnr
        ';

        $query = $this->getEntityManager()->createQuery($dql)->setMaxResults(1000);

        $query->setParameter('dlnr', $dlnr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
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
