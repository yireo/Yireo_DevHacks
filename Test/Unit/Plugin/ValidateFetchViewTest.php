<?php declare(strict_types=1);

namespace Yireo\DevHacks\Test\Unit\Plugin;

use InvalidArgumentException;
use Magento\Framework\App\State;
use Magento\Framework\View\Element\Template;
use PHPUnit\Framework\TestCase;
use Yireo\DevHacks\Plugin\ValidateFetchView;

class ValidateFetchViewTest extends TestCase
{
    public function testThrowsOnEmptyFileNameInDeveloperMode(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getPlugin(State::MODE_DEVELOPER)->beforeFetchView($this->getBlock(), '');
    }

    public function testPassesEmptyFileNameInProductionMode(): void
    {
        $result = $this->getPlugin(State::MODE_PRODUCTION)->beforeFetchView($this->getBlock(), '');
        $this->assertSame([''], $result);
    }

    public function testPassesEmptyFileNameInDefaultMode(): void
    {
        $result = $this->getPlugin(State::MODE_DEFAULT)->beforeFetchView($this->getBlock(), '');
        $this->assertSame([''], $result);
    }

    public function testPassesFileNameInDeveloperMode(): void
    {
        $result = $this->getPlugin(State::MODE_DEVELOPER)->beforeFetchView($this->getBlock(), '/tmp/foo.phtml');
        $this->assertSame(['/tmp/foo.phtml'], $result);
    }

    private function getPlugin(string $mode): ValidateFetchView
    {
        $appState = $this->createMock(State::class);
        $appState->method('getMode')->willReturn($mode);

        return new ValidateFetchView($appState);
    }

    private function getBlock(): Template
    {
        return $this->createMock(Template::class);
    }
}
