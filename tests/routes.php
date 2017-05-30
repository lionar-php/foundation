<?php

class route
{
	public static function get ( string $uri, string $request )
	{
		global $router;
		global $application;

		return $router->get ( $uri, $application->taskFor ( $request ) );
	}
}

route::get ( '/', 'i want to see my name' );