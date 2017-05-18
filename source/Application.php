<?php

namespace Foundation;

use Closure;
use Foundation\Exceptions\DuplicateRequestException;
use Foundation\Exceptions\UnknownRequestException;
use Illuminate\Container\Container;

class Application extends Container
{
	private $features = [ ];

	public function feature ( string $request, Closure $task )
	{
		if ( ! $this->canHandle ( $request ) )
			return $this->features [ $request ] = $task;
		throw new DuplicateRequestException ( $request );
	}

	public function canHandle ( string $request ) : bool
	{
		return array_key_exists ( $request, $this->features );
	}

	public function taskFor ( string $request ) : Closure
	{
		if ( ! $this->canHandle ( $request ) )
			throw new UnknownRequestException ( $request );
		return $this->features [ $request ];
	}

	public function bind ( $abstract, $concrete = null, $shared = false )
	{
		if ( $concrete instanceOf Closure )
			return $this->binding ( $abstract, $concrete, $shared );
		return parent::bind ( $abstract, $concrete, $shared );
	}

	private function binding ( string $abstract, Closure $concrete, bool $shared = false )
	{
		parent::bind ( $abstract, function ( Container $container, array $parameters = [ ] ) use ( $concrete )
		{
			return $this->call ( $concrete, $parameters );
		}, $shared );
	}
}
