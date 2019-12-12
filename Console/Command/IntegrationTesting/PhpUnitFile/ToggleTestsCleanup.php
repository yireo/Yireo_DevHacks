<?php
declare(strict_types=1);

namespace Yireo\DevHacks\Console\Command\IntegrationTesting\PhpUnitFile;

use Magento\Framework\Exception\FileSystemException;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\ConstantNotFound;
use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\FileNotFound;
use Yireo\DevHacks\Exception\IntegrationTesting\PhpUnitFile\InvalidContent;
use Yireo\DevHacks\Utilities\IntegrationTesting\PhpUnitFile\Constant;

/**
 * Class ToggleTestsCleanup
 * @package Jola\DevHacks\Console\Command\IntegrationTesting\PhpUnitFile
 */
class ToggleTestsCleanup extends Command
{
    /**
     * @var Constant
     */
    private $phpUnitConstant;

    /**
     * ToggleTestsCleanup constructor.
     * @param Constant $phpUnitConstant
     * @param null $name
     */
    public function __construct(
        Constant $phpUnitConstant,
        $name = null
    ) {
        parent::__construct($name);
        $this->phpUnitConstant = $phpUnitConstant;
    }

    /**
     * Configure this Symfony command
     */
    protected function configure()
    {
        $this->setName('yireo_devhacks:toggle_testscleanup')
            ->setDescription('Toggle the variable TESTS_CLEANUP in dev/tests/integration/phpunit.xml');
    }

    /**
     * Execute this Symfony command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws ConstantNotFound
     * @throws FileNotFound
     * @throws InvalidContent
     * @throws FileSystemException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currentValue = $this->phpUnitConstant->getValue('TESTS_CLEANUP');
        $newValue = ($currentValue == 'enabled') ? 'disabled' : 'enabled';

        if ($this->phpUnitConstant->changeValue('TESTS_CLEANUP', $newValue) === true) {
            $msg = sprintf('Constant "%s" has been switched from "%s" to "%s"',
                "TESTS_CLEANUP",
                $currentValue,
                $newValue
            );

            return $output->writeln($msg);
        }

        return $output->writeln('Constant "TESTS_CLEANUP" has not been changed');
    }
}
