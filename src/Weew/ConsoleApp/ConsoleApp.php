<?php

namespace Weew\ConsoleApp;

use Weew\App\App;
use Weew\Console\ContainerAware\Console;
use Weew\Console\IConsole;
use Weew\ConsoleApp\Commands\ConfigDumpCommand;

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
        $this->console->parseArgv($argv);
    }

    /**
     * @param array $args
     */
    public function parseArgs(array $args) {
        $this->console->parseArgs($args);
    }

    /**
     * @param $string
     */
    public function parseString($string) {
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
        ]);
    }
}
