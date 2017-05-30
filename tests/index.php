<?php

use Foundation\Application;
use Foundation\Routing\Router;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;

require __DIR__ . '/../vendor/autoload.php';


// Create a service container
$application = new Application;

class name
{
	public function __construct ( $full )
	{
		$this->full = $full;
	}

	public function __toString ( )
	{
		return $this->full;
	}
}

$application->bind ( name::class, function ( $name )
{
	return new name ( $name );
} );

$application->feature ( 'i want to see my name', function ( name $name )
{
	echo $name;
} );

// Create a request from server variables, and bind it to the container; optional
$request = Request::capture ( );
$application->instance('Illuminate\Http\Request', $request);

// Using Illuminate/Events/Dispatcher here (not required); any implementation of
// Illuminate/Contracts/Event/Dispatcher is acceptable
$events = new Dispatcher ( $application );

$router = new Router ( $events, $application );


require __DIR__ . '/routes.php';

// $redirect = new Redirector ( new UrlGenerator ( $router->getRoutes ( ), $request ) );

// use redirect
// return $redirect->home();
// return $redirect->back();
// return $redirect->to('/');

$response = $router->dispatch ( $request );

$response->send ( );