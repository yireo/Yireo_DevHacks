<?php

declare(strict_types=1);

namespace Yireo\DevHacks\Override;

use Magento\Framework\App\State as AppState;
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
     * @var AppState
     */
    private $appState;

    /**
     * PathValidatorFix constructor.
     * @param AppState $appState
     * @param DriverPool $driverPool
     */
    public function __construct(
        AppState $appState,
        DriverPool $driverPool
    ) {
        parent::__construct($driverPool);
        $this->appState = $appState;
        $this->customDriverPool = $driverPool;
    }

    /**
     * @param string $path
     * @param string $driverCode
     * @return DirectoryReadInterface
     */
    public function create($path, $driverCode = DriverPool::FILE)
    {
        if ($this->appState->getMode() !== AppState::MODE_DEVELOPER) {
            return parent::create($path, $driverCode);
        }

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
