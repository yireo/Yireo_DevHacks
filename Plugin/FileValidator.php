<?php

declare(strict_types=1);

namespace Yireo\DevHacks\Plugin;

use Magento\Framework\App\State as AppState;

/**
 * Class FileValidator
 * @package Yireo\DevHacks\Plugin
 */
class FileValidator
{
    /**
     * @var AppState
     */
    private $appState;

    /**
     * FileValidator constructor.
     * @param AppState $appState
     */
    public function __construct(
        AppState $appState
    ) {
        $this->appState = $appState;
    }

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
        if ($this->appState->getMode() !== AppState::MODE_DEVELOPER) {
            return $proceed($filename);
        }

        if ($filename == false || !is_file($filename)) {
            return false;
        }

        return $proceed($filename) || file_exists($filename);
    }
}
