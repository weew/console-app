<?php

namespace Weew\ConsoleApp;

use Weew\App\IApp;
use Weew\Console\IConsole;

interface IConsoleApp extends IApp {
    /**
     * @return IConsole
     */
    function getConsole();

    /**
     * @param array $argv
     */
    function parseArgv(array $argv = null);

    /**
     * @param array $args
     */
    function parseArgs(array $args);

    /**
     * @param $string
     */
    function parseString($string);
}
