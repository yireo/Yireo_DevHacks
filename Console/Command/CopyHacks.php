<?php declare(strict_types=1);

namespace Yireo\DevHacks\Console\Command;

use Magento\Framework\Filesystem\Directory\PathValidator;
use Magento\Framework\View\Element\Template\File\Validator as TemplateFileValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CopyHacks extends Command
{
    protected function configure()
    {
        $this->setName('yireo_devhacks:copy_hacks')
            ->setDescription('Copy some hacks');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $copyDir = dirname(__DIR__) . '/../Copy';
        $copies = [
            PathValidator::class => 'PathValidator.php',
            TemplateFileValidator::class => 'TemplateFileValidator.php'
        ];

        foreach ($copies as $className => $copyFile) {
            $originalFile = (new \ReflectionClass($className))->getFileName();
            if (!file_exists($originalFile)) {
                $output->writeln('<error>Original file does not exist: ' . $originalFile . '</error>');
                continue;
            }

            $copyFile = $copyDir . '/' . $copyFile;
            if (!file_exists($copyFile)) {
                $output->writeln('<error>Hack file does not exist: ' . $copyFile . '</error>');
                continue;
            }

            copy($copyFile, $originalFile);
        }

        return 0;
    }
}
