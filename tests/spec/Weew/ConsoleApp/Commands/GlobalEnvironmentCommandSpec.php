<?php

namespace tests\spec\Weew\ConsoleApp\Commands;

use PhpSpec\ObjectBehavior;
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

    function it_runs(IInput $input, IOutput $output, IConsoleApp $app) {
        $this->run($input, $output, $app);
    }
}
