<?php

use Foundation\Application;

require __DIR__ . '/../vendor/autoload.php';

$application = new Application;

require __DIR__ . '/readability.php';

interface NotBoundDependency
{

}

class Unresolvable
{
	public function __construct ( NotBoundDependency $d )
	{

	}
}


bind ( 'i want to see the dashboard', function ( Unresolvable $greetor )
{
	echo 'hello there';
} );

bind ( 'i want to add an exercise to the trainer', function ( Missing $greetor )
{
	echo 'hello there';
} );

bind ( 'i want to add an exercise to the trainer', function ( Missing $greetor )
{
	echo 'hello there';
} );

bind ( 'i want to add see an exercise list', function ( NotBoundDependency $greetor )
{
	echo 'hello there';
} );

$application->make ( 'i want to see the dashboard' );
// $application->make ( 'i want to add an exercise to the trainer' );
// $application->make ( 'i want to add see an exercise list' );