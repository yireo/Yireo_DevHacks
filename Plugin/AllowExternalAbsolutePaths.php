<?php declare(strict_types=1);

namespace Yireo\DevHacks\Plugin;

use Magento\Framework\Filesystem\Driver\File;

class AllowExternalAbsolutePaths
{
    /**
     * @param File $subject
     * @param callable $proceed
     * @param string $basePath
     * @param string $path
     * @param string|null $scheme
     * @return string
     */
    public function aroundGetAbsolutePath(File $subject, callable $proceed, $basePath, $path, $scheme = null): string
    {
        if (!empty($path) && preg_match('#^/#', $path)) {
            return $path;
        }

        return $proceed($basePath, $path, $scheme);
    }
}
