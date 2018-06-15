<?php

namespace Gweb\TecdocBundle\EventListener;

use Gweb\TecdocBundle\Service\TranslateManager;

/**
 * Translate tecdoc entity when loaded
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class TranslateListener
{
    /**
     * @var TranslateManager
     */
    private $translateManager;

    /**
     * @var bool
     */
    private $translateAutoload;

    /**
     * TranslateListener constructor.
     * @param TranslateManager $translateManager
     * @param bool $translateAutoload
     */
    public function __construct(TranslateManager $translateManager, bool $translateAutoload)
    {
        $this->translateManager = $translateManager;
        $this->translateAutoload = $translateAutoload;
    }

    /**
     * Get translation after entity loaded
     * @param $entity
     * @return void
     */
    public function postLoad($entity): void
    {
        if (!$this->translateAutoload) {
            return;
        }

        if (method_exists($entity, 'setDescription')) {
            if (method_exists($entity, 'getLbeznr') && $entity->getLbeznr() !== null) {
                $entity->setDescription($this->translateManager->getCountryDescription($entity->getLbeznr()));
            }

            if (method_exists($entity, 'getBeznr') && $entity->getBeznr() !== null) {
                $entity->setDescription($this->translateManager->getLanguageDescription($entity->getBeznr()));
            }
        }

        if (method_exists($entity, 'setTextmodule')
          && method_exists($entity, 'getTbsnr')
          && $entity->getTbsnr() !== null) {
            $entity->setTextmodule($this->translateManager->getTextModule($entity->getDlnr(), $entity->getTbsnr()));
        }

        if (method_exists($entity, 'setImage')
          && method_exists($entity, 'getBildnr')
          && $entity->getBildnr() !== null) {
            $entity->setImage($this->translateManager->getImage($entity->getBildnr(), $entity->getDokumentenart()));
        }
    }

}
