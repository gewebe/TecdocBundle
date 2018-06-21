<?php

namespace Gweb\TecdocBundle\Service;

use Gweb\TecdocBundle\Entity\Tecdoc012CountryDescription;
use Gweb\TecdocBundle\Entity\Tecdoc020Language;
use Gweb\TecdocBundle\Entity\Tecdoc030LanguageDescription;
use Gweb\TecdocBundle\Entity\Tecdoc035TextModule;
use Gweb\TecdocBundle\Entity\Tecdoc231Image;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Translate tecdoc entities by requested language
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class TranslateManager
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $languageDefault;

    /**
     * @var int
     */
    private $languageId;

    /**
     * TranslateManager constructor.
     * @param EntityManager $entityManager
     * @param RequestStack $requestStack
     * @param string $languageDefault
     */
    public function __construct(EntityManager $entityManager, RequestStack $requestStack, string $languageDefault)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->languageDefault = $languageDefault;
    }

    /**
     * Get language id, if not set load from request or default isocode
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getLanguageId(): int
    {
        if ($this->languageId) {
            return $this->languageId;
        }

        $request = $this->requestStack->getCurrentRequest();
        if ($request && $request->get('lang')) {
            $this->setLanguageIdByIsocode($request->get('lang'));
        } else {
            $this->setLanguageIdByIsocode($this->languageDefault);
        }

        return $this->languageId;
    }

    /**
     * Set current language id
     * @param string $isocode
     * @return void
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function setLanguageIdByIsocode(string $isocode): void
    {
        $language = $this->entityManager->getRepository(Tecdoc020Language::class)->findOneByIsocode(
            $isocode
        );

        if (!$language) {
            throw new \RuntimeException('Language not found');
        }

        $this->languageId = $language->getSprachNr();
    }

    /**
     * Get country description by id
     * @param int $lbeznr
     * @return null|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCountryDescription(int $lbeznr): ?string
    {
        $repo = $this->entityManager->getRepository(Tecdoc012CountryDescription::class);

        $description = $repo->findDescription($lbeznr, $this->getLanguageId());

        if ($description) {
            return $description->getBez();
        }
        return null;
    }

    /**
     * Get language description by id
     * @param int $beznr
     * @return null|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getLanguageDescription(int $beznr): ?string
    {
        $repo = $this->entityManager->getRepository(Tecdoc030LanguageDescription::class);

        $description = $repo->findDescription($beznr, $this->getLanguageId());

        if ($description) {
            return $description->getBez();
        }
        return null;
    }

    /**
     * Get text module by supplier-id and text-id
     * @param int $dlnr
     * @param int $tbsnr
     * @return null|string
     */
    public function getTextModule(int $dlnr, int $tbsnr): ?string
    {
        $repo = $this->entityManager->getRepository(Tecdoc035TextModule::class);

        $textmodule = $repo->findOneBy(
            [
            'dlnr' => $dlnr,
            'tbsnr' => $tbsnr,
            'sprachnr' => $this->getLanguageId(),
            ]
        );

        if ($textmodule) {
            return $textmodule->getBez();
        }
        return null;
    }

    /**
     * Get image by id and document-type
     * @param int $bildnr
     * @param int $dokumentenart
     * @return Tecdoc231Image
     */
    public function getImage(int $bildnr, int $dokumentenart): Tecdoc231Image
    {
        $repo = $this->entityManager->getRepository(Tecdoc231Image::class);

        return $repo->findOneBy(
            [
            'bildnr' => $bildnr,
            'dokumentenart' => $dokumentenart,
            'sprachnr' => [$this->getLanguageId(), 255],
            ]
        );
    }
}
