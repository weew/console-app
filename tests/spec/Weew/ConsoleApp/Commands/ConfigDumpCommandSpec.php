<?php

namespace tests\spec\Weew\ConsoleApp\Commands;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\Config\Config;
use Weew\Console\Input;
use Weew\Console\Output;
use Weew\ConsoleApp\Commands\ConfigDumpCommand;
use Weew\ConsoleArguments\Command;

/**
 * @mixin ConfigDumpCommand
 */
class ConfigDumpCommandSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType(ConfigDumpCommand::class);
    }

    function it_setups() {
        $command = new Command();
        $this->setup($command);
        it($command->getName())->shouldBe('config:dump');
    }

    function it_runs() {
        $input = new Input();
        $output = new Output();
        $output->setEnableBuffering(true);
        $config = new Config();
        $config->set('some', ['nested' => ['value']]);

        $this->run($input, $output, $config);
    }

    function it_dumps_flat(Input $input) {
        $input->getOption('--flat')->willReturn(true);
        $input->getArgument('node')->willReturn(null);

        $output = new Output();
        $output->setEnableBuffering(true);
        $config = new Config();
        $config->set('some', ['nested' => ['value']]);

        $this->run($input, $output, $config);
    }

    function it_dumps_a_single_node(Input $input) {
        $input->getOption('--flat')->willReturn(true);
        $input->getArgument('node')->willReturn('some.nested');

        $output = new Output();
        $output->setEnableBuffering(true);
        $config = new Config();
        $config->set('some', ['nested' => 'value']);

        $this->run($input, $output, $config);
    }

    function it_dumps_a_single_non_array_node(Input $input) {
        $input->getOption('--flat')->willReturn(true);
        $input->getArgument('node')->willReturn('some.nested.value');

        $output = new Output();
        $output->setEnableBuffering(true);
        $config = new Config();
        $config->set('some', ['nested' => 'value']);

        $this->run($input, $output, $config);
    }

    function it_does_not_dump_empty_config() {
        $input = new Input();
        $output = new Output();
        $output->setEnableBuffering(true);
        $config = new Config();

        $this->run($input, $output, $config);
    }
}
