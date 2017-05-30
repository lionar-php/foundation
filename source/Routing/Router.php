<?php

namespace Foundation\Routing;

class Router extends \Illuminate\Routing\Router
{
	protected function newRoute ( $methods, $uri, $action )
    {
        return ( new Route ( $methods, $uri, $action ) )
                    ->setRouter ( $this )
                    ->setContainer ( $this->container );
    }

	public function __get ( $property )
	{
		if ( isset ( $this->{$property} ) )
			return $this->{$property};
		throw new \InvalidArgumentException ( "Property $property does not exist." );
	}
}