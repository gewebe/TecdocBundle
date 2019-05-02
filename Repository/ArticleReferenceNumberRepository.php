<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc203ArticleReferenceNumber;

/**
 * Entity repository for ArticleReferenceNumber
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleReferenceNumberRepository extends TranslateEntityRepository
{
    /**
     * Find article reference numbers
     * @param int $dlnr
     * @param string $artnr
     * @return Tecdoc203ArticleReferenceNumber[]|null
     */
    public function findByArticle(int $dlnr, string $artnr): ?array
    {
        $dql = 'SELECT articleReference,
                       manufacturer,
                       description
                FROM Gweb\TecdocBundle\Entity\Tecdoc203ArticleReferenceNumber articleReference
                LEFT JOIN articleReference.manufacturer manufacturer
                LEFT JOIN manufacturer.description description WITH description.sprachnr = :sprachnr
                WHERE articleReference.dlnr = :dlnr
                AND articleReference.artnr = :artnr
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr);
        $query->setParameter('artnr', $artnr);
        $query->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
