<?php

namespace tests\spec\Weew\ConsoleApp;

use PhpSpec\ObjectBehavior;
use Weew\Console\ContainerAware\Console;
use Weew\Console\IConsole;
use Weew\ConsoleApp\ConsoleApp;
use Weew\ConsoleApp\IConsoleApp;

/**
 * @mixin ConsoleApp
 */
class ConsoleAppSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(ConsoleApp::class);
    }

    function it_shares_instances_in_the_container() {
        $this->getContainer()->has(IConsoleApp::class)->shouldBe(true);
        $this->getContainer()->has(ConsoleApp::class)->shouldBe(true);
        $this->getContainer()->has(IConsole::class)->shouldBe(true);
        $this->getContainer()->has(Console::class)->shouldBe(true);
    }

    function it_returns_console() {
        $this->getConsole()->shouldHaveType(Console::class);
    }

    function it_parses_args() {
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->handleArgs([]);
    }

    function it_parses_argv() {
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->handleArgv([]);
    }

    function it_parses_string() {
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->handleArgsString('');
    }

    function it_takes_environment() {
        $this->beConstructedWith('prod');
        $this->getConsole()->getOutput()->setEnableBuffering(true);
        $this->getEnvironment()->shouldBe('prod');
    }

    function it_switches_environment() {
        $this->setDebug(true);
        $this->handleArgsString('--env=prod');
        $this->getEnvironment()->shouldBe('prod');
    }

    function it_does_not_switch_environment_if_environment_awareness_has_not_been_configured() {
        $this->setDebug(false);
        $this->handleArgsString('--env=prod');
        $this->getEnvironment()->shouldBe('dev');
    }
}
