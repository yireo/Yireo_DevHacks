<?php declare(strict_types=1);

namespace Magento\Framework\Filesystem\Directory;

use Magento\Framework\Filesystem\DriverInterface;

/**
 * @inheritDoc
 *
 * Validates paths using driver.
 */
class PathValidator implements PathValidatorInterface
{
    /**
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
    }

    /**
     * @inheritDoc
     */
    public function validate(
        string $directoryPath,
        string $path,
        ?string $scheme = null,
        bool $absolutePath = false
    ): void {}
}
