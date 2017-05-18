<?php

route::get ( '/', 'i want to see the dashboard' );

use Illuminate\Contracts\Routing\Registrar;

class route extends facade
{
	public static function get ( string $uri, string $request )
	{
		return $this->container [ Registrar::class ]->get ( $uri, $this->application->taskFor ( $request ) );
	}

	public static function post ( string $uri, string $request )
	{
		return $this->container [ Registrar::class ]->get ( $uri, $this->application->taskFor ( $request ) );
	}

	public static function put ( string $uri, string $request )
	{
		return $this->container [ Registrar::class ]->put ( $uri, $this->application->taskFor ( $request ) );
	}

	public static function delete ( string $uri, string $request )
	{
		return $this->container [ Registrar::class ]->delete ( $uri, $this->application->taskFor ( $request ) );
	}

	public static function any ( string $uri, string $request )
	{
		return $this->container [ Registrar::class ]->any ( $uri, $this->application->taskFor ( $request ) );
	}
}


function when ( string $request, Closure $action )
{
	application::feature ( $request, $action );
}



$realrouter->get ( '/', 

function (  )
{

} );