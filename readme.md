# Console App

[![Build Status](https://img.shields.io/travis/weew/php-console-app.svg)](https://travis-ci.org/weew/php-console-app)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/php-console-app.svg)](https://scrutinizer-ci.com/g/weew/php-console-app)
[![Test Coverage](https://img.shields.io/coveralls/weew/php-console-app.svg)](https://coveralls.io/github/weew/php-console-app)
[![Version](https://img.shields.io/packagist/v/weew/php-console-app.svg)](https://packagist.org/packages/weew/php-console-app)
[![Licence](https://img.shields.io/packagist/l/weew/php-console-app.svg)](https://packagist.org/packages/weew/php-console-app)

## Table of contents

## Installation

`composer require weew/php-console-app`

## Introduction

This is a very minimalistic wrapper for a console application. It is basically an integration of these two packages [weew/php-app](https://github.com/weew/php-app) and [weew/php-console](https://github.com/weew/php-console).

## Usage

Just create a new instance and your ready to go.

```php
$app = new ConsoleApp();
// returns IConsole
$app->getConsole();
```
