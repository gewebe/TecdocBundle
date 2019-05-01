<?php

namespace Gweb\TecdocBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Gweb\TecdocBundle\Service\TranslateManager;

/**
 * Tecdoc API Controller
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ApiController extends AbstractFOSRestController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var TranslateManager
     */
    protected $translateManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslateManager $translateManager
    ) {
        $this->entityManager = $entityManager;
        $this->translateManager = $translateManager;
    }

    /**
     * get tecdoc entity manager
     * @param string $className
     * @return ObjectRepository
     */
    protected function getRepository(string $className): ObjectRepository
    {
        $repository = $this->entityManager->getRepository($className);

        if (method_exists($repository, 'setLanguageId')) {
            $repository->setLanguageId($this->translateManager->getLanguageId());
        }

        return $repository;
    }
}
