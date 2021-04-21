<?php declare(strict_types=1);

namespace Yireo\DevHacks\Override;

use Magento\Framework\Filesystem\Directory\Read;

class DirectoryReadWithPathFixed extends Read
{
    protected function validatePath(?string $path, ?string $scheme = null, bool $absolutePath = false): void
    {
    }
}