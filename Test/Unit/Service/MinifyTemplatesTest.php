<?php declare(strict_types=1);

namespace Yireo\DevHacks\Test\Unit\Service;

use Magento\Framework\App\State;
use Magento\Framework\App\Utility\Files;
use Magento\Framework\View\Template\Html\MinifierInterface;
use PHPUnit\Framework\TestCase;
use Yireo\DevHacks\Service\MinifyTemplates;

class MinifyTemplatesTest extends TestCase
{
    public function testSkipsMinificationInDeveloperMode(): void
    {
        $files = $this->createMock(Files::class);
        $files->expects($this->never())->method('getPhtmlFiles');
        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->expects($this->never())->method('minify');

        $service = new MinifyTemplates($files, $minifier, $this->getAppState(State::MODE_DEVELOPER));
        $this->assertSame(0, $service->minifyTemplates());
    }

    public function testMinifiesInProductionMode(): void
    {
        $files = $this->createMock(Files::class);
        $files->method('getPhtmlFiles')->willReturn(['a.phtml', 'b.phtml']);
        $minifier = $this->createMock(MinifierInterface::class);
        $minifier->expects($this->exactly(2))->method('minify');

        $service = new MinifyTemplates($files, $minifier, $this->getAppState(State::MODE_PRODUCTION));
        $this->assertSame(2, $service->minifyTemplates());
    }

    private function getAppState(string $mode): State
    {
        $appState = $this->createMock(State::class);
        $appState->method('getMode')->willReturn($mode);

        return $appState;
    }
}
