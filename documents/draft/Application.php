<?php

namespace Foundation;

use DI\ContainerBuilder;

class Application
{
	public function __construct ( )
	{
		$this->container = ( new ContainerBuilder )->build ( );
	}

	public function share ( $abstract, Closure $concrete )
	{
		$this->container->set ( $abstract, $concrete );
	}

	public function make ( $abstract )
	{
		$this->container->make ( $abstract );
	}

	public function bind ( $abstract, Closure $concrete )
	{
		$this->container->set ( $abstract, DI\factory ( $concrete )->scope ( Scope::PROTOTYPE ) );
	}
}

'MyClass2' => DI\factory(function () {
    return new MyClass2();
})->scope(Scope::PROTOTYPE),