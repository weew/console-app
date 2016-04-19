<?php

namespace Weew\ConsoleApp;

use Weew\App\App;
use Weew\Console\ContainerAware\Console;
use Weew\Console\IConsole;
use Weew\ConsoleApp\Commands\ConfigDumpCommand;
use Weew\ConsoleApp\Commands\GlobalEnvironmentCommand;
use Weew\ConsoleArguments\IOption;
use Weew\ConsoleArguments\Option;
use Weew\ConsoleArguments\OptionType;

class ConsoleApp extends App implements IConsoleApp {
    /**
     * @var IConsole
     */
    protected $console;

    /**
     * ConsoleApp constructor.
     *
     * @param null $environment
     */
    public function __construct($environment = null) {
        parent::__construct($environment);

        $this->console = $this->createConsole();

        $this->container->set([ConsoleApp::class, IConsoleApp::class], $this);
        $this->container->set([Console::class, IConsole::class], $this->console);

        $this->addDefaultCommands();
    }

    /**
     * @return IConsole
     */
    public function getConsole() {
        return $this->console;
    }

    /**
     * @param array $argv
     */
    public function parseArgv(array $argv = null) {
        $option = $this->createEnvOption();
        $option->parseArgv($argv);
        $this->detectEnvFromOption($option);

        $this->start();
        $this->console->parseArgv($argv);
    }

    /**
     * @param array $args
     */
    public function parseArgs(array $args) {
        $option = $this->createEnvOption();
        $option->parseArgs($args);
        $this->detectEnvFromOption($option);

        $this->start();
        $this->console->parseArgs($args);
    }

    /**
     * @param $string
     */
    public function parseString($string) {
        $option = $this->createEnvOption();
        $option->parseString($string);
        $this->detectEnvFromOption($option);

        $this->start();
        $this->console->parseString($string);
    }

    /**
     * @return IConsole
     */
    protected function createConsole() {
        return new Console($this->getContainer());
    }

    /**
     * Register default commands.
     */
    protected function addDefaultCommands() {
        $this->getConsole()->addCommands([
            ConfigDumpCommand::class,
            GlobalEnvironmentCommand::class,
        ]);
    }

    /**
     * @return Option
     */
    protected function createEnvOption() {
        return new Option(OptionType::SINGLE_OPTIONAL, '--env');
    }

    /**
     * @param IOption $option
     */
    protected function detectEnvFromOption(IOption $option) {
        if ($option->hasValue()) {
            $this->setEnvironment($option->getValue());
        }
    }
}
