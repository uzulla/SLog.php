SLog.php
=======

Singleton and Simple, PSR-3 Logger Container

but, Only Monolog now.

WHY?
========

I want use something like a Object::Container(perl).

and, some convinience feature.

SYNOPSIS
========

## setup

```
<?php
$app_log = new \Monolog\Logger('APP');
$app_log->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'app.log', \Monolog\Logger::DEBUG));
\Uzulla\SLog::setLogger('APP', $app_log);
```

## use

```
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

```
<?php
// any setup.
\Uzulla\SLog::debug('uhoh!!'); // ok!
```

that do like 

```
<?php

$app_log = new \Monolog\Logger('_');
$app_log->pushHandler(new \Monolog\Handler\StreamHandler('php://stderr', \Monolog\Logger::DEBUG));
\Uzulla\SLog::setLogger('_', $app_log);

//...

L::getLogger('_')->info("uhoh!");
```

this is usable in haste.(but not smart)

NOTICE: php-fpm will not capture stderr output( in default settings, check `catch_workers_output`).  
