<?php
declare(strict_types=1);

namespace Yireo\DevHacks\Plugin;

use Magento\Framework\Filesystem\Directory\ReadFactory;
use Magento\Framework\Filesystem\Directory\Read;
use Magento\Framework\Filesystem\DriverPool;

/**
 * Class PathValidatorFix
 * @package Yireo\DevHacks\Plugin
 */
class PathValidatorFix extends ReadFactory
{
    protected $driverPool2;

    /**
     * PathValidatorFix constructor.
     * @param DriverPool $driverPool
     */
    public function __construct(
        DriverPool $driverPool) {
        parent::__construct($driverPool);
        $this->driverPool2 = $driverPool;
    }

    /**
     * @param string $path
     * @param string $driverCode
     * @return Read|\Magento\Framework\Filesystem\Directory\ReadInterface
     */
    public function create($path, $driverCode = DriverPool::FILE)
    {
        $driver = $this->driverPool2->getDriver($driverCode);
        $factory = new \Magento\Framework\Filesystem\File\ReadFactory(
            $this->driverPool2
        );

        return new Read(
            $factory,
            $driver,
            $path
        );
    }
}
