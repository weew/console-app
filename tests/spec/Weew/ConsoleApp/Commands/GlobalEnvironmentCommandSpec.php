<?php

namespace tests\spec\Weew\ConsoleApp\Commands;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Console\IInput;
use Weew\Console\IOutput;
use Weew\ConsoleApp\Commands\GlobalEnvironmentCommand;
use Weew\ConsoleApp\IConsoleApp;
use Weew\ConsoleArguments\Command;

/**
 * @mixin GlobalEnvironmentCommand
 */
class GlobalEnvironmentCommandSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(GlobalEnvironmentCommand::class);
    }

    function it_setups() {
        $command = new Command();
        $this->setup($command);
        it($command->isGlobal())->shouldBe(true);
        it($command->isHidden())->shouldBe(true);
    }

    function it_does_nothing_without_flag(IInput $input, IOutput $output, IConsoleApp $app) {
        $input->hasOption('--env')->willReturn(false);
        $this->run($input, $output, $app);
    }

    function it_detects_environment(IInput $input, IOutput $output, IConsoleApp $app) {
        $input->hasOption('--env')->willReturn(true);
        $input->getOption('--env')->willReturn('env');
        $app->setEnvironment('env')->shouldBeCalled();
        $this->run($input, $output, $app);
    }
}
