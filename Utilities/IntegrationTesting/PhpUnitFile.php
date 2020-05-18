<?php
declare(strict_types=1);

namespace Yireo\DevHacks\Utilities\IntegrationTesting;

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\File\ReadFactory;
use Magento\Framework\Filesystem\File\WriteFactory;

use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\InvalidContent;
use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\FileNotFound;

/**
 * Class PhpUnitFile
 * @package Yireo\DevHacks\Utilities\IntegrationTesting
 */
class PhpUnitFile
{
    /**
     * @var DirectoryList
     */
    private $directoryList;

    /**
     * @var ReadFactory
     */
    private $readFactory;

    /**
     * @var WriteFactory
     */
    private $writeFactory;

    /**
     * Constant constructor.
     * @param DirectoryList $directoryList
     * @param ReadFactory $readFactory
     * @param WriteFactory $writeFactory
     */
    public function __construct(
        DirectoryList $directoryList,
        ReadFactory $readFactory,
        WriteFactory $writeFactory
    ) {
        $this->directoryList = $directoryList;
        $this->readFactory = $readFactory;
        $this->writeFactory = $writeFactory;
    }

    /**
     * Write to the PhpUnitFile
     *
     * @param string $content
     * @return string
     * @throws FileNotFound
     * @throws FileSystemException
     * @throws InvalidContent
     */
    public function writeContent(string $content): bool
    {
        if ($this->validateContent($content) === false) {
            throw new InvalidContent(sprintf('Content is invalid: %s', $content));
        }

        $file = $this->getFilePath();
        $write = $this->writeFactory->create($file, 'file', 'w');
        $write->write($content);
        $write->close();
        return true;
    }

    /**
     * Read the content of the PhpUnitFile
     *
     * @return string
     * @throws InvalidContent
     * @throws FileNotFound
     */
    public function getContent(): string
    {
        $file = $this->getFilePath();
        $read = $this->readFactory->create($file, 'file');
        $content = (string)$read->readAll();

        if ($this->validateContent($content) === false) {
            throw new InvalidContent(sprintf('Content of file "%s" is invalid: %s', $file, $content));
        }

        return $content;
    }

    /**
     * Get the file path of the PhpUnitFile
     *
     * @return string
     * @throws FileNotFound
     */
    public function getFilePath(): string
    {
        $file = $this->directoryList->getRoot() . '/dev/tests/integration/phpunit.xml';
        if (file_exists($file)) {
            return $file;
        }

        throw new FileNotFound(__(sprintf('%s not found', $file)));
    }

    /**
     * Validate content
     *
     * @param string $content
     * @return bool
     */
    private function validateContent(string $content): bool
    {
        if (empty($content)) {
            return false;
        }

        if (!strstr($content, '<phpunit')) {
            return false;
        }

        return true;
    }
}
