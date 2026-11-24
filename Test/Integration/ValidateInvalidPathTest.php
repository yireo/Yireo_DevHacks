<?php declare(strict_types=1);

namespace Yireo\DevHacks\Test\Integration;

use Magento\Framework\Filesystem\Directory\PathValidator;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

class ValidateInvalidPathTest extends TestCase
{
    public function testIfInvalidPathStillWorks(): void
    {
        $pathValidator = Bootstrap::getObjectManager()->get(PathValidator::class);
        $pathValidator->validate('/proc', 'foobar');
        $this->addToAssertionCount(1);
    }
}
