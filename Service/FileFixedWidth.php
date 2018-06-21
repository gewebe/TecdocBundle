<?php

namespace Gweb\TecdocBundle\Service;

use Symfony\Component\HttpFoundation\File\File;

/**
 * A parser class for handling fixed width files
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class FileFixedWidth
{
    /**
     * @var \SplFileObject
     */
    private $file;

    /**
     * @var array
     */
    private $columns;

    /**
     * FileFixedWidth constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->setFilename($filename);
    }

    /**
     * Set file name
     * @param string $filename
     * @return void
     */
    public function setFilename(string $filename): void
    {
        $file = new File($filename);

        $this->file = $file->openFile('r');
    }

    /**
     * Add column to file definition
     * @param string $name
     * @param int $start
     * @param int $length
     * @return void
     */
    public function addColumn(string $name, int $start, int $length): void
    {
        $this->columns[$name] = [
            'start' => $start,
            'length' => $length,
        ];
    }

    /**
     * Read row from file
     * @return array|bool
     */
    public function getRow()
    {
        if ($this->file->eof()) {
            return false;
        }

        $line = $this->file->fgets();
        if ($line == '') {
            return false;
        }

        $row = [];
        foreach ($this->columns as $name => $column) {
            $row[$name] = mb_substr($line, $column['start'], $column['length']);
        }

        return $row;
    }

}
