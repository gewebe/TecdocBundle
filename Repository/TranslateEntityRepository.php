<?php

namespace Gweb\TecdocBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Translation Entity Repository
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class TranslateEntityRepository extends EntityRepository
{
    /**
     * @var int
     */
    protected $languageId = 0;

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
    }
}
