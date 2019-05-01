<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc211ArticleGenericArticle;

/**
 * Entity repository for ArticleGenericArticle
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleGenericArticleRepository extends TranslateEntityRepository
{
    /**
     * Find generic articles by article dlnr, artnr
     * @param int $dlnr
     * @param string $artnr
     * @return Tecdoc211ArticleGenericArticle[]
     */
    public function findByArticle(int $dlnr, string $artnr): array
    {
        $dql = 'SELECT article,
                       genericArticle,
                       description,
                       assembly,
                       assemblyDescription,
                       standardised,
                       standardisedDescription,
                       usage,
                       usageDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc211ArticleGenericArticle article
                JOIN article.genericArticle genericArticle
                JOIN genericArticle.description description WITH description.sprachnr = :sprachnr
                JOIN genericArticle.genericArticleAssembly assembly
                JOIN assembly.description assemblyDescription WITH assemblyDescription.sprachnr = :sprachnr
                JOIN genericArticle.genericArticleStandardised standardised
                JOIN standardised.description standardisedDescription WITH standardisedDescription.sprachnr = :sprachnr
                JOIN genericArticle.genericArticleUsage usage
                JOIN usage.description usageDescription WITH usageDescription.sprachnr = :sprachnr
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
