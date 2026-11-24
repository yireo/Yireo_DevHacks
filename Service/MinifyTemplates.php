<?php declare(strict_types=1);

namespace Yireo\DevHacks\Service;

use Magento\Deploy\Service\MinifyTemplates as OriginalMinifyTemplates;
use Magento\Framework\App\State;
use Magento\Framework\App\Utility\Files;
use Magento\Framework\View\Template\Html\MinifierInterface;

class MinifyTemplates extends OriginalMinifyTemplates
{
    public function __construct(
        Files $filesUtils,
        MinifierInterface $htmlMinifier,
        private readonly State $appState
    ) {
        parent::__construct($filesUtils, $htmlMinifier);
    }

    /**
     * @return int
     */
    public function minifyTemplates()
    {
        if ($this->appState->getMode() === State::MODE_DEVELOPER) {
            return 0;
        }

        return parent::minifyTemplates();
    }
}
