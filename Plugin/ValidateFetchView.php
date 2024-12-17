<?php declare(strict_types=1);

namespace Yireo\DevHacks\Plugin;

use Magento\Framework\View\Element\Template;

class ValidateFetchView
{
    /**
     * @param Template $subject
     * @param string $fileName
     * @return array
     */
    public function beforeFetchView(Template $subject, $fileName): array
    {
        if (empty($fileName)) {
            throw new \InvalidArgumentException(
                'Block "'.$subject->getNameInLayout().'" with template "'.$subject->getTemplate(
                ).'" has no template file'
            );
        }

        return [$fileName];
    }
}
