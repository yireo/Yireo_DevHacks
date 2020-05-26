<?php

declare(strict_types=1);

namespace Yireo\DevHacks\Override;

use Magento\Framework\Filesystem\Directory\ReadFactory as DirectoryReadFactory;
use Magento\Framework\Filesystem\Directory\Read as DirectoryRead;
use Magento\Framework\Filesystem\Directory\ReadInterface as DirectoryReadInterface;
use Magento\Framework\Filesystem\DriverPool;
use Magento\Framework\Filesystem\File\ReadFactory as FileReadFactory;

/**
 * Class DirectoryReadFactoryWithPathFixed
 * @package Yireo\DevHacks\Override
 */
class DirectoryReadFactoryWithPathFixed extends DirectoryReadFactory
{
    /**
     * @var DriverPool
     */
    private $customDriverPool;

    /**
     * PathValidatorFix constructor.
     * @param DriverPool $driverPool
     */
    public function __construct(
        DriverPool $driverPool
    ) {
        parent::__construct($driverPool);
        $this->customDriverPool = $driverPool;
    }

    /**
     * @param string $path
     * @param string $driverCode
     * @return DirectoryReadInterface
     */
    public function create($path, $driverCode = DriverPool::FILE)
    {
        $driver = $this->customDriverPool->getDriver($driverCode);
        $factory = new FileReadFactory(
            $this->customDriverPool
        );

        return new DirectoryRead(
            $factory,
            $driver,
            $path
        );
    }
}
