SLog.php
=======

Singleton and Simple, PSR-3 Logger Container

WHY?
========

I want use something like a Object::Container(perl).

and, some convinience feature.

SYNOPSIS
========

## setup

Sample using monolog.

```php
<?php
$app_log = new \Monolog\Logger('APP');
$app_log->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'app.log', \Monolog\Logger::DEBUG));
\Uzulla\SLog::setLogger('APP', $app_log);
```

## use

```php
<?php
use \Uzulla\SLog as L;

// any location

$logger = L::getLogger('APP'); 
$logger->debug('debug me!!');
//or
L::getLogger('APP')->info("log!", ['why'=>'kantanbenri']); 
```

KANTANBENRI
=========

```php
<?php
// any setup.
\Uzulla\SLog::debug('uhoh!!'); // ok!
```

that do like 

```php
<?php

$app_log = new \Uzulla\SLog\SimpleLogger(); // about SimpleLogger, see under.
\Uzulla\SLog::setLogger('_', $app_log);

//...

L::getLogger('_')->info("uhoh!");
```

this is usable in haste.(but not smart)


Simple Logger
=============

This library contain simple PSR-3 Logger `\Uzulla\SLog\SimpleLogger`.


```php
<?php
use \Uzulla\SLog\SimpleLogger;

// out put to error_log(), log level DEBUG.
$log = new SimpleLogger();
// or
// out put to error_log(), log level NOTICE
$log = new SimpleLogger(SimpleLogger::NOTICE);
// or
// out put to 'test.log', log level WARNING
$log = new SimpleLogger(SimpleLogger::WARNING, __DIR__.'/test.log');

// ...

$log->alert('ALERT!!!');
```

That use error_log(). unless setting log filename.


LICENSE
=======

MIT

