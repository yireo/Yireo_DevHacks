<?php
declare(strict_types=1);

namespace Yireo\DevHacks\Utilities\IntegrationTesting\PhpUnitFile;

use Magento\Framework\Exception\FileSystemException;

use Yireo\DevHacks\Utilities\IntegrationTesting\PhpUnitFile;
use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\ConstantNotFound;
use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\FileNotFound;
use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\InvalidContent;

/**
 * Class Constant
 * @package Yireo\DevHacks\Utilities\IntegrationTesting\PhpUnitFile
 */
class Constant
{
    /**
     * @var PhpUnitFile
     */
    private $phpUnitFile;

    /**
     * Constant constructor.
     *
     * @param PhpUnitFile $phpUnitFile
     */
    public function __construct(
        PhpUnitFile $phpUnitFile
    ) {
        $this->phpUnitFile = $phpUnitFile;
    }

    /**
     * @param string $name
     * @return string
     * @throws FileNotFound
     * @throws ConstantNotFound
     * @throws InvalidContent
     */
    public function getValue(string $name): string
    {
        $content = $this->phpUnitFile->getContent();

        if (preg_match('/<const name="' . $name . '"(.*)value="([^\"]+)"([^>]+)>/', $content, $match)) {
            return $match[2];
        }

        throw new ConstantNotFound(__('Unable to find constant'));
    }

    /**
     * @param string $name
     * @param string $value
     * @return bool
     * @throws FileNotFound
     * @throws FileSystemException
     * @throws InvalidContent
     */
    public function changeValue(string $name, string $value): bool
    {
        $content = $this->phpUnitFile->getContent();

        $newValue = '<const name="' . $name . '" value="' . $value . '"/>';
        $regex = '/<const name="' . $name . '"(.*)value="([^\"]+)"([^>]+)>/';

        if ($newContent = preg_replace($regex, $newValue, $content)) {
            $this->phpUnitFile->writeContent($newContent);
            return true;
        }

        return false;
    }
}
