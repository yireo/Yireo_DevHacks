<?php declare(strict_types=1);

namespace Yireo\DevHacks\Service;

use Magento\Deploy\Service\MinifyTemplates as OriginalMinifyTemplates;

class MinifyTemplates extends OriginalMinifyTemplates
{
    /**
     * @return int
     */
    public function minifyTemplates()
    {
        return 0;
    }
}
