<?php declare(strict_types=1);

namespace Yireo\DevHacks\Override;

use Magento\Framework\View\Element\Template\File\Validator;

class TemplateFileValidator extends Validator
{
    public function isValid($filename)
    {
        return true;
    }
}