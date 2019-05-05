<?php

namespace Gweb\TecdocBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;
use Gweb\TecdocBundle\Entity\Tecdoc401ArticleLinkageText;

/**
 * Entity repository for ArticleLinkageText
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ArticleLinkageTextRepository extends TranslateEntityRepository
{
    /**
     * Find article vehicle text
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $ktypnr
     * @return Tecdoc401ArticleLinkageText[]
     */
    public function findByArticleVehicle(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $ktypnr
    ): array {
        return $this->findByArticleLinkage(
            $dlnr,
            $artnr,
            $genartnr,
            Tecdoc400ArticleLinkage::LINKAGE_VEHICLE,
            $ktypnr
        );
    }

    /**
     * Find article linkage text
     * @param int $dlnr
     * @param string $artnr
     * @param int $genartnr
     * @param int $vknzielart (2: KTypNr, 7: HerNr, 14: MotNr, 16: CVTypNr, 19: AxleTypNr)
     * @param int $vknzielnr
     * @return Tecdoc401ArticleLinkageText[]
     */
    public function findByArticleLinkage(
        int $dlnr,
        string $artnr,
        int $genartnr,
        int $vknzielart,
        int $vknzielnr
    ): array {
        $dql = 'SELECT article,
                       articleText
                FROM Gweb\TecdocBundle\Entity\Tecdoc401ArticleLinkageText article
                LEFT JOIN Gweb\TecdocBundle\Entity\Tecdoc035TextModule articleText
                    WITH articleText.dlnr = article.dlnr
                    AND articleText.tbsnr = article.tbsnr
                    AND articleText.sprachnr = :sprachnr
                WHERE article.dlnr = :dlnr
                AND article.artnr = :artnr
                AND article.genartnr = :genartnr
                AND article.vknzielart = :vknzielart
                AND article.vknzielnr = :vknzielnr
                ORDER BY article.sortnr ASC, articleText.lfdnr ASC
        ';

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('dlnr', $dlnr)
            ->setParameter('artnr', $artnr)
            ->setParameter('genartnr', $genartnr)
            ->setParameter('vknzielart', $vknzielart)
            ->setParameter('vknzielnr', $vknzielnr)
            ->setParameter('sprachnr', $this->languageId);

        $result = $query->getResult();

        $text = [];
        foreach ($result as $entity) {
            if ($entity instanceof Tecdoc401ArticleLinkageText) {
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
