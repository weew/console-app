# Console App

[![Build Status](https://img.shields.io/travis/weew/console-app.svg)](https://travis-ci.org/weew/console-app)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/console-app.svg)](https://scrutinizer-ci.com/g/weew/console-app)
[![Test Coverage](https://img.shields.io/coveralls/weew/console-app.svg)](https://coveralls.io/github/weew/console-app)
[![Version](https://img.shields.io/packagist/v/weew/console-app.svg)](https://packagist.org/packages/weew/console-app)
[![Licence](https://img.shields.io/packagist/l/weew/console-app.svg)](https://packagist.org/packages/weew/console-app)

## Table of contents

## Installation

`composer require weew/console-app`

## Introduction

This is a very minimalistic wrapper for a console application. It is basically an integration of these two packages [weew/app](https://github.com/weew/app) and [weew/console](https://github.com/weew/console).

## Usage

Just create a new instance and your ready to go.

```php
$app = new ConsoleApp();

// returns IConsole
$app->getConsole();

// start app
$app->start();

// run console
$app->parseArgv($argv);
```

Be aware that the `--env` switch is only available if debug mode has been enabled.
