<?php

namespace Weew\ConsoleApp\Commands;

use Weew\Console\IInput;
use Weew\Console\IOutput;
use Weew\ConsoleApp\IConsoleApp;
use Weew\ConsoleArguments\ICommand;
use Weew\ConsoleArguments\OptionType;

class GlobalEnvironmentCommand {
    /**
     * @param ICommand $command
     */
    public function setup(ICommand $command) {
        $command->setGlobal(true)->setHidden(true);
        $command->option(OptionType::SINGLE_OPTIONAL, '--env')
            ->setDescription('Set application environment');
    }

    /**
     * @param IInput $input
     * @param IOutput $output
     * @param IConsoleApp $app
     */
    public function run(IInput $input, IOutput $output, IConsoleApp $app) {
        // this command is only for show; the whole environment detection
        // is done inside the console application
    }
}
