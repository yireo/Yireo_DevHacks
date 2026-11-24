<?php declare(strict_types=1);

namespace Yireo\DevHacks\Test\Integration;

use Magento\Deploy\Service\MinifyTemplates as OriginalMinifyTemplates;
use Magento\Framework\View\Element\Template;
use PHPUnit\Framework\TestCase;
use Yireo\DevHacks\Plugin\ValidateFetchView;
use Yireo\DevHacks\Service\MinifyTemplates;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertInterceptorPluginIsRegistered;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsEnabled;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsRegistered;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertPreferenceOf;

class ModuleTest extends TestCase
{
    use AssertModuleIsEnabled;
    use AssertModuleIsRegistered;
    use AssertInterceptorPluginIsRegistered;
    use AssertPreferenceOf;

    public function testIfModuleIsEnabled(): void
    {
        $this->assertModuleIsEnabled('Yireo_DevHacks');
        $this->assertModuleIsRegistered('Yireo_DevHacks');
    }

    public function testIfMinifyTemplatesPreferenceIsActive(): void
    {
        $this->assertPreferenceOf(MinifyTemplates::class, OriginalMinifyTemplates::class);
    }

    /**
     * @magentoAppArea frontend
     */
    public function testIfValidateFetchViewPluginIsRegistered(): void
    {
        $this->assertInterceptorPluginIsRegistered(
            Template::class,
            ValidateFetchView::class,
            'ValidateFetchView'
        );
    }
}
