<?php

namespace Gweb\TecdocBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
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
    /** @var EntityManagerInterface */
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
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $requestStack
     * @param string $languageDefault
     */
    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, string $languageDefault)
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
            return $this->setLanguageIdByIsocode($request->get('lang'));
        }

        foreach ($request->getLanguages() as $language) {
            try {
                return $this->setLanguageIdByIsocode($language);
            } catch (\RuntimeException $e) {}
        }

        return $this->setLanguageIdByIsocode($this->languageDefault);
    }

    /**
     * Set current language id
     * @param string $isocode
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function setLanguageIdByIsocode(string $isocode): int
    {
        $language = $this->entityManager->getRepository(Tecdoc020Language::class)->findOneByIsocode(
            $isocode
        );

        if (!$language) {
            throw new \RuntimeException('Language not found');
        }

        $this->languageId = $language->getSprachNr();

        return $this->languageId;
    }

    /**
     * Get country description by id
     * @param int $lbeznr
     * @return Tecdoc012CountryDescription|null
     */
    public function getCountryDescription(int $lbeznr): ?Tecdoc012CountryDescription
    {
        $repo = $this->entityManager->getRepository(Tecdoc012CountryDescription::class);

        return $repo->findDescription($lbeznr, $this->getLanguageId());
    }

    /**
     * Get language description by id
     * @param int $beznr
     * @return Tecdoc030LanguageDescription|null
     */
    public function getLanguageDescription(int $beznr): ?Tecdoc030LanguageDescription
    {
        $repo = $this->entityManager->getRepository(Tecdoc030LanguageDescription::class);

        return $repo->findDescription($beznr, $this->getLanguageId());
    }

    /**
     * Get text modules by datasupplier-id and text-id
     * @param int $dlnr
     * @param string $tbsnr
     * @return ArrayCollection|null
     */
    public function getTextModule(int $dlnr, string $tbsnr): ?ArrayCollection
    {
        $repo = $this->entityManager->getRepository(Tecdoc035TextModule::class);

        $text = $repo->findBy(
            [
            'dlnr' => $dlnr,
            'tbsnr' => $tbsnr,
            'sprachnr' => $this->getLanguageId(),
            ]
        );

        return new ArrayCollection($text);
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
