<?php

namespace Gweb\TecdocBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * File table annotation for fixed width file
 *
 * @Annotation
 * @Target("CLASS")
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
final class Table extends Annotation
{
    /**
     * table name: 001
     *
     * @var string
     */
    public $name;

    /**
     * has reference data
     *
     * @var bool
     */
    public $reference;

    /**
     * has provider data
     *
     * @var bool
     */
    public $provider;
}
