<?php

namespace Gweb\TecdocBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Extract functions for tecdoc 7z compressed files
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class FileExtract
{
    /**
     * Extract reference compressed file
     * @param string $dirSource
     * @param string $dirTarget
     * @param string $version
     * @return void
     */
    public static function reference(string $dirSource, string $dirTarget, string $version): void
    {
        $filesystem = new Filesystem();

        if ($filesystem->exists($dirTarget)) {
            $filesystem->remove($dirTarget);
        }
        $filesystem->mkdir($dirTarget);

        $file = $dirSource.'/REFERENCE_DATA_'.$version.'.7z';

        self::extract($file, $dirTarget);
    }

    /**
     * Extract suppliers compressed files
     * @param string $dirSource
     * @param string $dirTarget
     * @return void
     */
    public static function suppliers(string $dirSource, string $dirTarget): void
    {
        $filesystem = new Filesystem();
        if (!$filesystem->exists($dirTarget)) {
            $filesystem->mkdir($dirTarget);
        }

        $finder = new Finder();
        $finder->files()->in($dirSource);

        foreach ($finder as $file) {

            $fileName = explode('.', $file->getBasename(), 2);

            $supplierId = $fileName[0];
            $dirTargetSupplier = $dirTarget.'/'.$supplierId;

            if ($filesystem->exists($dirTargetSupplier)) {
                $filesystem->remove($dirTargetSupplier);
            }
            $filesystem->mkdir($dirTargetSupplier);

            self::extract($file->getPathname(), $dirTargetSupplier);
        }
    }

    /**
     * Extract suppliers compressed media files
     * @param string $dirSource
     * @param string $dirTarget
     * @return void
     */
    public static function media(string $dirSource, string $dirTarget): void
    {
        $suppliers = [];

        /**
         * @var SplFileInfo $file
         */
        foreach (self::getMediaFiles($dirSource, $dirTarget) as $file) {

            // get supplier id from filename
            preg_match('~([0-9]+)_(pic|doc)\.7z\.001~i', $file->getBasename(), $matches);
            $supplierId = ltrim($matches[1], '0');

            $filesystem = new Filesystem();

            // cleanup existing directory
            if (!in_array($supplierId, $suppliers)) {
                $suppliers[] = $supplierId;

                if ($filesystem->exists($dirTarget.'/'.$supplierId)) {
                    $filesystem->remove($dirTarget.'/'.$supplierId);
                }
                $filesystem->mkdir($dirTarget.'/'.$supplierId);
            }

            self::extract($file->getPathname(), $dirTarget.'/'.$supplierId);

            // change mod for public read to directory recursively
            #$filesystem->chmod($dirTarget.'/'.$supplierId, 0644, 0000, true);
        }
    }

    /**
     * Get suppliers compressed media files if newer than existing directory
     * @param string $dirSource
     * @param string $dirTarget
     * @return array
     */
    public static function getMediaFiles(string $dirSource, string $dirTarget): array
    {
        $files = [];

        $filesystem = new Filesystem();

        $finder = new Finder();
        $finder->files()->in($dirSource)->sortByName();

        foreach ($finder as $file) {
            // match only first file from sequence and get supplier id
            if (preg_match('~([0-9]+)_(pic|doc)\.7z\.001~i', $file->getBasename(), $matches)) {
                $supplierId = ltrim($matches[1], '0');

                // if target directory exists
                if ($filesystem->exists($dirTarget.'/'.$supplierId)) {

                    // skip file if target directory is newer
                    $dirTargetTime = filemtime($dirTarget.'/'.$supplierId.'/.');
                    if ($file->getMTime() < $dirTargetTime) {
                        continue;
                    }
                }

                $files[] = $file;
            }
        }

        return $files;
    }

    /**
     * Run 7z extract command
     * @param string $filename
     * @param string $dirTarget
     * @return void
     */
    private static function extract(string $filename, string $dirTarget): void
    {
        passthru('7z x -y -o'.$dirTarget.' '.$filename);
    }

}
