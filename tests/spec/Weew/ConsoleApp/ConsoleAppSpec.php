<?php

namespace tests\spec\Weew\ConsoleApp;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Console\ContainerAware\Console;
use Weew\ConsoleApp\ConsoleApp;

/**
 * @mixin ConsoleApp
 */
class ConsoleAppSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(ConsoleApp::class);
    }

    function it_returns_console() {
        $this->getConsole()->shouldHaveType(Console::class);
    }

    function it_parses_args() {
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->parseArgs([]);
    }

    function it_parses_argv() {
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->parseArgv([]);
    }

    function it_parses_string() {
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->parseString('');
    }

    function it_takes_environment() {
        $this->beConstructedWith('prod');
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->getEnvironment()->shouldBe('prod');
    }
}