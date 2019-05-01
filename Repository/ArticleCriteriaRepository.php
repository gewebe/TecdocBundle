<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc210ArticleCriteria;

/**
 * Entity repository for ArticleCriteria
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleCriteriaRepository extends TranslateEntityRepository
{
    /**
     * Find criterias by article dlnr, artnr
     * @param int $dlnr
     * @param string $artnr
     * @return Tecdoc210ArticleCriteria[]
     */
    public function findByArticle(int $dlnr, string $artnr): array
    {
        $dql = 'SELECT article,
                       criteria,
                       description
                FROM Gweb\TecdocBundle\Entity\Tecdoc210ArticleCriteria article
                JOIN article.criteria criteria
                JOIN criteria.description description WITH description.sprachnr = :sprachnr
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr)
            ->setParameter('artnr', $artnr)
            ->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
