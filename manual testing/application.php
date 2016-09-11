<?php

use Foundation\Application;

require __DIR__ . '/../vendor/autoload.php';

interface Greeter
{
	public function greet ( );
}

class TextGreeter implements Greeter
{
	public function greet ( )
	{
		return 'Jaajaa';
	}
}

$application = new Application;

$application->bind ( 'Greeter', function ( )
{
	return new TextGreeter;
} );

$application->share ( 'greet', function ( Greeter $greeter )
{
	return $greeter->greet ( );
} );

dd ( $application->make ( 'greet' ) );