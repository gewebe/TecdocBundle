<?php

namespace Gweb\TecdocBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * File column annotation for fixed width file
 *
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
final class Column extends Annotation
{
    /**
     * Column start position
     *
     * @var int
     */
    public $start;

    /**
     * Column width
     *
     * @var int
     */
    public $width;

    /**
     * Column name (inherited from ORM\Column name)
     *
     * @var string name
     */
    public $name;

    /**
     * Column type (inherited from ORM\Column type)
     *
     * @var string type
     */
    public $type;
}
