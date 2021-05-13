<?php declare(strict_types=1);

namespace Yireo\DevHacks\Test\Live;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Filesystem\Directory\PathValidator;
use PHPUnit\Framework\TestCase;

class ValidateInvalidPathTest extends TestCase
{
    public function testIfInvalidPathStillWorks()
    {
        $om = ObjectManager::getInstance();
        /** @var PathValidator $pathValidator */
        $pathValidator = $om->get(PathValidator::class);
        $return = $pathValidator->validate('/proc', 'foobar');
        $this->assertEmpty($return);
    }
}