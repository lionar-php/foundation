<?php

namespace Foundation;

use Closure;
use DI\Container;
use DI\ContainerBuilder;
use DI\Scope;
use Foundation\Exceptions\InexistentDependencyException;
use Foundation\Exceptions\UnresolvableDependencyException;
use InvalidArgumentException;
use ReflectionException;
use TypeError;

class Application implements \Agreed\Technical\Application
{
	private $container = null;

	public function __construct ( Container $container = null )
	{
		$this->container = ( $container ) ?: ( new ContainerBuilder )->build ( );
	}

	public function share ( $abstract, Closure $concrete )
	{
		$this->check ( $abstract );
		$this->container->set ( $abstract, $concrete );
	}

	public function bind ( $abstract, Closure $concrete )
	{
		$this->check ( $abstract );
		$this->container->set ( $abstract, \DI\factory ( $concrete )->scope ( Scope::PROTOTYPE ) );
	}

	public function make ( $abstract )
	{
		$this->check ( $abstract );
		if ( ! $this->has ( $abstract ) )
			throw new InvalidArgumentException ( "$abstract is not registered in the application" );
		return $this->execute ( $abstract );
	}

	public function has ( $abstract ) : bool
	{
		$this->check ( $abstract );
		return ( bool ) $this->container->has ( $abstract );
	}

	public function call ( Closure $concrete, array $arguments = array ( ) )
	{
		return $this->container->call ( $concrete, $arguments );
	}

	private function check ( $abstract )
	{
		if ( ! is_string ( $abstract ) or empty ( $abstract ) )
			throw new InvalidArgumentException ( '$abstract must be a non empty string' );
	}

	private function execute ( $abstract )
	{
		try {
			return $this->container->get ( $abstract );
		} catch ( ReflectionException $e ) {
			throw new InexistentDependencyException ( $abstract, explode ( ' ', $e->getMessage ( ) ) [ 1 ] );
		} catch ( TypeError $e ) {
			throw new UnresolvableDependencyException ( $abstract, rtrim ( explode ( ' ', $e->getMessage ( ) ) [ 8 ], ',' ) );
		}
	}
}