<?php

use DI\ContainerBuilder;
use DI\Scope;

require __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder;
$container = $builder->build ( );

$container->set ( 'test', 'hello' );
// dd ( $container->get ( 'test' ) );

$container->set ( 'Hello', DI\factory ( function ( ) { echo 'Hi there'; } )->scope ( Scope::PROTOTYPE ) );

dd($container->get('Hello'));