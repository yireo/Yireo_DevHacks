<?php
declare(strict_types=1);

namespace Yireo\DevHacks\Plugin;

/**
 * Class FileValidator
 * @package Yireo\DevHacks\Plugin
 */
class FileValidator
{
    /**
     * Allow for any file as long as it exists to be used for a template
     *
     * @param object $subject
     * @param callback $proceed
     * @param string $filename
     * @return bool
     **/
    public function aroundIsValid($subject, $proceed, $filename)
    {
        if ($filename == false || !is_file($filename)) {
            return false;
        }

        return $proceed($filename) || file_exists($filename);
    }
}
