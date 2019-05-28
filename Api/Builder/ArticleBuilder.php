<?php

namespace Gweb\TecdocBundle\Api\Builder;

use Gweb\TecdocBundle\Api\Model\Article;
use Gweb\TecdocBundle\Api\Model\ArticleCriteria;
use Gweb\TecdocBundle\Api\Model\ArticleGeneric;
use Gweb\TecdocBundle\Api\Model\ArticleReference;
use Gweb\TecdocBundle\Api\Model\ArticleText;
use Gweb\TecdocBundle\Api\Model\ArticleVehicle;
use Gweb\TecdocBundle\Entity\Tecdoc052KeyTableEntry;
use Gweb\TecdocBundle\Entity\Tecdoc120VehicleType;
use Gweb\TecdocBundle\Entity\Tecdoc200Article;
use Gweb\TecdocBundle\Entity\Tecdoc203ArticleReferenceNumber;
use Gweb\TecdocBundle\Entity\Tecdoc204ArticleSupersedeNumber;
use Gweb\TecdocBundle\Entity\Tecdoc206ArticleText;
use Gweb\TecdocBundle\Entity\Tecdoc207ArticleTradeNumber;
use Gweb\TecdocBundle\Entity\Tecdoc209ArticleEAN;
use Gweb\TecdocBundle\Entity\Tecdoc210ArticleCriteria;
use Gweb\TecdocBundle\Entity\Tecdoc211ArticleGenericArticle;
use Gweb\TecdocBundle\Entity\Tecdoc232ArticleImage;
use Gweb\TecdocBundle\Entity\Tecdoc400ArticleLinkage;
use Gweb\TecdocBundle\Entity\Tecdoc401ArticleLinkageText;
use Gweb\TecdocBundle\Entity\Tecdoc410ArticleLinkageCriteria;
use Gweb\TecdocBundle\Entity\Tecdoc432ArticleLinkageImage;
use Gweb\TecdocBundle\Repository\ArticleRepository;
use Hateoas\Configuration\Route;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\Factory\PagerfantaFactory;
use Hateoas\Representation\PaginatedRepresentation;

class ArticleBuilder extends ApiBuilder
{
    /**
     * @param int $supplierId
     * @param int $page
     * @param int $limit
     * @return PaginatedRepresentation
     */
    public function getArticleBySupplier(int $supplierId, int $page, int $limit): PaginatedRepresentation
    {
        /**
         * @var ArticleRepository $repository
         */
        $repository = $this->getRepository(Tecdoc200Article::class);
        $pagerfanta = $repository->findByDatasupplierPager($supplierId, $page, $limit);

        $articles = [];
        foreach ($pagerfanta->getCurrentPageResults() as $result) {
            $articles[] = $this->buildArticle($result);
        }

        $linkFactory = new PagerfantaFactory('page', 'limit');
        return $linkFactory->createRepresentation(
            $pagerfanta,
            new Route(
                'article_by_supplier',
                ['supplierId' => $supplierId]
            ),
            new CollectionRepresentation($articles)
        );
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return Article|null
     */
    public function getArticle(int $supplierId, string $articleId): ?Article
    {
        $repository = $this->getRepository(Tecdoc200Article::class);
        $article = $repository->findByArticle($supplierId, $articleId);

        if (!$article) {
            return null;
        }

        return $this->buildArticle($article);
    }

    /**
     * @param Tecdoc200Article $entity
     * @return Article
     */
    public function buildArticle(Tecdoc200Article $entity): Article
    {
        $article = new Article();
        $article->setSupplierId($entity->getDlnr());
        $article->setArticleId($entity->getArtnr());

        return $article;
    }

    /**
     * @param Article $article
     * @return void
     */
    public function buildDocument(Article $article): void
    {
        $supplierId = $article->getSupplierId();
        $articleId = $article->getArticleId();

        $article->setEan($this->getEan($supplierId, $articleId));

        $article->setReferenceNumbers($this->getReferenceNumbers($supplierId, $articleId));
        $article->setSupersedeNumbers($this->getSupersedeNumbers($supplierId, $articleId));
        $article->setTradeNumbers($this->getTradeNumbers($supplierId, $articleId));

        $article->setGenericArticles($this->getGenericArticles($supplierId, $articleId));

        $article->setCriterias($this->getCriterias($supplierId, $articleId));

        $article->setImages($this->getImages($supplierId, $articleId));

        $article->setTexts($this->getTexts($supplierId, $articleId));

        foreach ($article->getGenericArticles() as $genericArticle) {
            $vehicles = $this->getVehicles(
                $supplierId,
                $articleId,
                $genericArticle->getId()
            );

            $genericArticle->setVehicles($vehicles);
        }
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return ArticleGeneric[]
     */
    public function getGenericArticles(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc211ArticleGenericArticle::class);
        $articleGenerics = $repository->findByArticle($supplierId, $articleId);

        $genericArticles = [];

        /**
         * @var $articleGeneric Tecdoc211ArticleGenericArticle
         */
        foreach ($articleGenerics as $articleGeneric) {
            $generic = new ArticleGeneric();
            $generic->setId($articleGeneric->getGenartnr());
            $generic->setName($articleGeneric->getGenericArticle()->getDescription()->getBez());
            $generic->setNameAssembly($articleGeneric->getGenericArticle()->getGenericArticleAssembly()->getDescription()->getBez());
            $generic->setNameStandardised($articleGeneric->getGenericArticle()->getGenericArticleStandardised()->getDescription()->getBez());
            $generic->setNameUsage($articleGeneric->getGenericArticle()->getGenericArticleUsage()->getDescription()->getBez());

            $genericArticles[$articleGeneric->getGenartnr()] = $generic;
        }

        return $genericArticles;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return ArticleCriteria[]
     */
    public function getCriterias(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc210ArticleCriteria::class);
        $articleCriterias = $repository->findByArticle($supplierId, $articleId);

        $criteria = [];

        foreach ($articleCriterias as $tecdocArticleCriteria) {
            $articleCriteria = new ArticleCriteria();
            $articleCriteria->setName($tecdocArticleCriteria->getCriteria()->getDescription()->getBez());

            if ($tecdocArticleCriteria->getCriteria()->getTyp() == 'K') {
                $value = $this->getKeyEntry(
                    $tecdocArticleCriteria->getCriteria()->getTabnr(),
                    $tecdocArticleCriteria->getKritwert()
                );
            } else {
                $value = $tecdocArticleCriteria->getKritwert();
            }

            $articleCriteria->setValue($value);

            $criteria[] = $articleCriteria;
        }

        return $criteria;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return array
     */
    public function getImages(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc232ArticleImage::class);
        $articleImages = $repository->findByArticle($supplierId, $articleId);

        $images = [];

        foreach ($articleImages as $articleImage) {
            $name = $articleImage->getImage()->getBildname();
            $name .= '.'.$articleImage->getImage()->getDocumentType()->getExtension();

            $images[] = $name;
        }

        return $images;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return ArticleText[]
     */
    public function getTexts(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc206ArticleText::class);
        $articleTexts = $repository->findByArticle($supplierId, $articleId);

        $texts = [];

        foreach ($articleTexts as $tecdocArticleText) {
            $text = '';
            foreach ($tecdocArticleText->getTextmodule() as $textmodule) {
                $text .= $textmodule->getText().' ';
            }

            $articleText = new ArticleText();
            $articleText->setImmediately($tecdocArticleText->isAnzsofort());
            $articleText->setText(trim($text));

            $texts[] = $articleText;
        }

        return $texts;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return string
     */
    public function getEan(int $supplierId, string $articleId): string
    {
        $repository = $this->getRepository(Tecdoc209ArticleEAN::class);

        $ean = $repository->findOneBy(
            [
                'dlnr' => $supplierId,
                'artnr' => $articleId,
            ]
        );

        return $ean->getEannr();
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return ArticleReference[]
     */
    public function getReferenceNumbers(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc203ArticleReferenceNumber::class);
        $articleReferences = $repository->findByArticle($supplierId, $articleId);

        $references = [];

        foreach ($articleReferences as $articleReference) {
            $manufacturerId = $articleReference->getHernr();

            if (isset($references[$manufacturerId])) {
                $number = $references[$manufacturerId];
            } else {
                $number = new ArticleReference();
                $number->setManufacturer($articleReference->getManufacturer()->getDescription()->getBez());
            }

            $number->addNumbers($articleReference->getRefnr());

            $references[$manufacturerId] = $number;
        }

        return $references;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return array
     */
    public function getSupersedeNumbers(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc204ArticleSupersedeNumber::class);
        $numbers = $repository->findBy([
            'dlnr' => $supplierId,
            'artnr' => $articleId
        ]);

        $supersedes = [];

        foreach ($numbers as $number) {
            $supersedes[] = $number->getErsatznr();
        }

        return $supersedes;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @return array
     */
    public function getTradeNumbers(int $supplierId, string $articleId): array
    {
        $repository = $this->getRepository(Tecdoc207ArticleTradeNumber::class);
        $numbers = $repository->findBy([
            'dlnr' => $supplierId,
            'artnr' => $articleId
        ]);

        $tradeNumbers = [];

        foreach ($numbers as $number) {
            $tradeNumbers[] = $number->getGebrnr();
        }

        return $tradeNumbers;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @param int $genericArticleId
     * @return ArticleVehicle[]
     */
    public function getVehicles(int $supplierId, string $articleId, int $genericArticleId): array
    {
        $repository = $this->getRepository(Tecdoc400ArticleLinkage::class);
        $tecdocVehicles = $repository->findVehicleByArticle(
            $supplierId,
            $articleId,
            $genericArticleId
        );

        $vehicles = [];

        if (!$tecdocVehicles) {
            return $vehicles;
        }

        /**
         * @var $tecdocVehicle Tecdoc120VehicleType
         */
        foreach ($tecdocVehicles as $tecdocVehicle) {
            $vehicle = VehicleBuilder::buildVehicle($tecdocVehicle);

            $articleVehicle = new ArticleVehicle();
            $articleVehicle->setVehicle($vehicle);
            $articleVehicle->setCriterias($this->getVehicleCriterias($supplierId, $articleId, $genericArticleId, $vehicle->getId()));
            $articleVehicle->setImages($this->getVehicleImages($supplierId, $articleId, $genericArticleId, $vehicle->getId()));
            $articleVehicle->setTexts($this->getVehicleTexts($supplierId, $articleId, $genericArticleId, $vehicle->getId()));

            $vehicles[] = $articleVehicle;
        }

        return $vehicles;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @param int $genericArticleId
     * @param int $vehicleId
     * @return ArticleCriteria[]
     */
    public function getVehicleCriterias(
        int $supplierId,
        string $articleId,
        int $genericArticleId,
        int $vehicleId
    ): array {
        $repository = $this->getRepository(Tecdoc410ArticleLinkageCriteria::class);
        $articleVehicleCriterias = $repository->findByArticleVehicle(
            $supplierId,
            $articleId,
            $genericArticleId,
            $vehicleId
        );

        $criterias = [];

        foreach ($articleVehicleCriterias as $articleVehicleCriteria) {
            $criteria = new ArticleCriteria();
            $criteria->setName($articleVehicleCriteria->getCriteria()->getDescription()->getBez());

            if ($articleVehicleCriteria->getCriteria()->getTyp() == 'K') {
                $value = $this->getKeyEntry(
                    $articleVehicleCriteria->getCriteria()->getTabnr(),
                    $articleVehicleCriteria->getKritwert()
                );
            } else {
                $value = $articleVehicleCriteria->getKritwert();
            }

            $criteria->setValue($value);

            $criterias[] = $criteria;
        }

        return $criterias;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @param int $genericArticleId
     * @param int $vehicleId
     * @return array
     */
    public function getVehicleImages(
        int $supplierId,
        string $articleId,
        int $genericArticleId,
        int $vehicleId
    ): array {
        $repository = $this->getRepository(Tecdoc432ArticleLinkageImage::class);
        $articleImages = $repository->findByArticleVehicle(
            $supplierId,
            $articleId,
            $genericArticleId,
            $vehicleId
        );

        $images = [];
        foreach ($articleImages as $articleImage) {
            $name = $articleImage->getImage()->getBildname();
            $name .= '.'.$articleImage->getImage()->getDocumentType()->getExtension();

            $images[] = $name;
        }

        return $images;
    }

    /**
     * @param int $supplierId
     * @param string $articleId
     * @param int $genericArticleId
     * @param int $vehicleId
     * @return ArticleText[]
     */
    public function getVehicleTexts(
        int $supplierId,
        string $articleId,
        int $genericArticleId,
        int $vehicleId
    ): array {
        $repository = $this->getRepository(Tecdoc401ArticleLinkageText::class);
        $articleVehicleTexts = $repository->findByArticleVehicle(
            $supplierId,
            $articleId,
            $genericArticleId,
            $vehicleId
        );

        $texts = [];

        foreach ($articleVehicleTexts as $tecdocArticleText) {
            $text = '';
            foreach ($tecdocArticleText->getTextmodule() as $textmodule) {
                $text .= $textmodule->getText().' ';
            }

            $articleText = new ArticleText();
            $articleText->setImmediately($tecdocArticleText->isAnzsofort());
            $articleText->setText(trim($text));

            $texts[] = $articleText;
        }

        return $texts;
    }

    /**
     * @param int $tabnr
     * @param string $key
     * @return string
     */
    public function getKeyEntry(int $tabnr, string $key): string
    {
        $repository = $this->getRepository(Tecdoc052KeyTableEntry::class);
        $keyEntry = $repository->findKeyEntry($tabnr, $key);

        return $keyEntry->getDescription()->getBez();
    }
}
