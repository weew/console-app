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
    function handleArgv(array $argv = null);

    /**
     * @param array $args
     */
    function handleArgs(array $args);

    /**
     * @param $string
     */
    function handleArgsString($string);
}
