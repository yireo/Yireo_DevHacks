<?php declare(strict_types=1);

namespace Yireo\DevHacks\Plugin;

use InvalidArgumentException;
use Magento\Framework\App\State;
use Magento\Framework\View\Element\Template;

class ValidateFetchView
{
    public function __construct(
        private readonly State $appState
    ) {
    }

    /**
     * @param Template $subject
     * @param string $fileName
     * @return array
     */
    public function beforeFetchView(Template $subject, $fileName): array
    {
        if (empty($fileName) && $this->appState->getMode() === State::MODE_DEVELOPER) {
            throw new InvalidArgumentException(
                'Block "'.$subject->getNameInLayout().'" with template "'.$subject->getTemplate(
                ).'" has no template file'
            );
        }

        return [$fileName];
    }
}
