<?php

namespace Gweb\TecdocBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Gweb\TecdocBundle\Entity\Tecdoc206ArticleText;

/**
 * Entity repository for Article Text
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleTextRepository extends TranslateEntityRepository
{
    /**
     * Find text by article dlnr, artnr
     * @param int $dlnr
     * @param string $artnr
     * @return Tecdoc206ArticleText[]
     */
    public function findByArticle(int $dlnr, string $artnr): array
    {
        $dql = 'SELECT article,
                       articleText
                FROM Gweb\TecdocBundle\Entity\Tecdoc206ArticleText article
                LEFT JOIN Gweb\TecdocBundle\Entity\Tecdoc035TextModule articleText
                    WITH articleText.dlnr = article.dlnr
                    AND articleText.tbsnr = article.tbsnr
                    AND articleText.sprachnr = :sprachnr
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
                ORDER BY article.sortnr ASC, articleText.lfdnr ASC
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr)
            ->setParameter('artnr', $artnr)
            ->setParameter('sprachnr', $this->languageId);

        $result = $query->getResult();
        
        $text = [];
        foreach ($result as $entity) {
            if ($entity instanceof Tecdoc206ArticleText) {
                $entity->setTextmodule(new ArrayCollection());
                $article = $entity;
                $text[] = $article;
                continue;
            }

            $article->addTextmodule($entity);
        }

        return $text;
    }
}
