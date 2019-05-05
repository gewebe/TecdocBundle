<?php

namespace Gweb\TecdocBundle\Repository;

use Gweb\TecdocBundle\Entity\Tecdoc052KeyTableEntry;
use Doctrine\ORM\EntityRepository;

/**
 * Entity repository for KeyTableEntry
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class KeyTableEntryRepository extends TranslateEntityRepository
{
    /**
     * Find key table entry
     * @param int $tabnr
     * @param string $key
     * @return Tecdoc052KeyTableEntry|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findKeyEntry(int $tabnr, string $key): ?Tecdoc052KeyTableEntry
    {
        $dql = "SELECT keyEntry,
                       keyTable,
                       keyEntryDescription,
                       keyTableDescription
                FROM Gweb\TecdocBundle\Entity\Tecdoc052KeyTableEntry keyEntry
                JOIN keyEntry.keyTable keyTable
                JOIN keyEntry.description keyEntryDescription WITH keyEntryDescription.sprachnr = :sprachnr
                JOIN keyTable.description keyTableDescription WITH keyTableDescription.sprachnr = :sprachnr
                WHERE keyEntry.tabnr = :tabnr
                AND (
                    (keyTable.tabtyp = 'N' AND keyEntry.key = :key_number)
                    OR 
                    (keyTable.tabtyp = 'A' AND keyEntry.key = :key_string)
                )
        ";

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setParameter('tabnr', $tabnr);
        $query->setParameter('sprachnr', $this->languageId);

        // integer stored with leading zeros
        $query->setParameter('key_number',  sprintf('%03d', $key));
        $query->setParameter('key_string', $key);

        return $query
            ->useQueryCache(true)
            ->useResultCache(true, 3600, Tecdoc052KeyTableEntry::class.$tabnr.$key)
            ->getOneOrNullResult();
    }
}
