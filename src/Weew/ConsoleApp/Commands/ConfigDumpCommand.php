<?php

namespace Weew\ConsoleApp\Commands;

use Weew\Config\IConfig;
use Weew\Console\IInput;
use Weew\Console\IOutput;
use Weew\ConsoleArguments\ArgumentType;
use Weew\ConsoleArguments\ICommand;
use Weew\ConsoleArguments\OptionType;

class ConfigDumpCommand {
    /**
     * @param ICommand $command
     */
    public function setup(ICommand $command) {
        $command->setName('config:dump')
            ->setDescription('Dump configuration');

        $command->argument(ArgumentType::SINGLE_OPTIONAL, 'node')
            ->setDescription('Config node name to dump');

        $command->option(OptionType::BOOLEAN, '--flat')
            ->setDescription('Flatten config tree');
    }

    /**
     * @param IInput $input
     * @param IOutput $output
     * @param IConfig $config
     */
    public function run(IInput $input, IOutput $output, IConfig $config) {
        $config = $config->toArray();
        $node = $input->getArgument('node');
        $flat = $input->getOption('--flat');

        if ($node !== null) {
            $config = array_get($config, $node, []);

            if ( ! is_array($config)) {
                $config = [$config];
            }
        }

        if ($flat) {
            $config = array_dot($config);
        }

        ksort($config);

        $output->writeLine(" <header>Config:</header>");

        if (count($config)) {
            $this->renderConfig($output, $config);
        } else {
            $output->writeLineIndented('There is no config yet');
        }
    }

    /**
     * @param IOutput $output
     * @param array $config
     * @param int $level
     * @param int $baseIndent
     */
    private function renderConfig(IOutput $output, array $config, $level = 1, $baseIndent = 2) {
        $indent = $level * $baseIndent;

        foreach ($config as $key => $value) {
            if (is_array($value)) {
                $output->writeLineIndented("<green>$key</green>: ", $indent);
                $this->renderConfig($output, $value, $level + 1, $baseIndent);
            } else {
                $output->writeLineIndented("<green>$key</green>: $value", $indent);
            }
        }
    }
}
