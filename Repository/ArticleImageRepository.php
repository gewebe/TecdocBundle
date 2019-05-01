<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc232ArticleImage;

/**
 * Entity repository for ArticleImage
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleImageRepository extends TranslateEntityRepository
{
    /**
     * Find images by article dlnr, artnr
     * @param int $dlnr
     * @param string $artnr
     * @return Tecdoc232ArticleImage[]
     */
    public function findByArticle(int $dlnr, string $artnr): array
    {
        $dql = 'SELECT article,
                       image,
                       documentType
                FROM Gweb\TecdocBundle\Entity\Tecdoc232ArticleImage article
                JOIN article.image image WITH image.sprachnr = :sprachnr OR image.sprachnr=255
                JOIN image.documentType documentType 
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
                ORDER BY article.sortnr ASC
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr)
            ->setParameter('artnr', $artnr)
            ->setParameter('sprachnr', $this->languageId);

        return $query->getResult();
    }
}
