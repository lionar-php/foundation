<?php

namespace Foundation\Routing;

use ReflectionParameter;

class Route extends \Illuminate\Routing\Route
{
	protected function transformDependency ( ReflectionParameter $parameter, $parameters )
    {
        $class = $parameter->getClass ( );

        // If the parameter has a type-hinted class, we will check to see if it is already in
        // the list of parameters. If it is we will just skip it as it is probably a model
        // binding and we do not want to mess with those; otherwise, we resolve it here.
        if ( $class && ! $this->alreadyInParameters ( $class->name, $parameters ) ) 
        	return $this->resolve ( $class->name, $this->router->currentRequest->all ( ) );
    }

    private function resolve ( string $abstract, array $parameters = [ ] )
    {
		return $this->container->makeWith ( $abstract, $parameters );
    }
}