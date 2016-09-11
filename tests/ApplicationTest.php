<?php

namespace Foundation\Tests;

use Foundation\Application;
use Mockery;
use Testing\TestCase;

class ApplicationTest extends TestCase
{
	private $application = null;

	public function setUp ( )
	{
		$this->container = Mockery::mock ( 'DI\\Container' );
		$this->application = new Application ( $this->container );
	}

	/*
	|--------------------------------------------------------------------------
	| Share method testing
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 * @expectedException  InvalidArgumentException
	 * @dataProvider  nonStringValues
	 */
	public function share_withNonStringValueForAbstract_throwsException ( $value )
	{
		$this->application->share ( $value, function ( ) { } );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function share_withEmptyStringValueForAbstract_throwsException ( )
	{
		$this->application->share ( '', function ( ) { } );
	}

	/**
	 * @test
	 */
	public function share_withStringValueForAbstract_registersAbstractInApplication ( )
	{
		$abstract = 'Engine';
		$concrete = function ( ) { };

		$this->container->shouldReceive ( 'set' )->with ( $abstract, $concrete )->once ( );
		$this->container->shouldReceive ( 'has' )->with ( $abstract )->once ( )->andReturn ( true );
		$this->container->shouldReceive ( 'get' )->with ( $abstract )->once ( )->andReturn ( $concrete );
		
		$this->application->share ( $abstract, $concrete );
		$this->assertSame ( $concrete, $this->application->make ( $abstract ) );
	}

	/*
	|--------------------------------------------------------------------------
	| Bind method testing
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 * @expectedException  InvalidArgumentException
	 * @dataProvider  nonStringValues
	 */
	public function bind_withNonStringValueForAbstract_throwsException ( $value )
	{
		$this->application->bind ( $value, function ( ) { } );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function bind_withEmptyStringValueForAbstract_throwsException ( )
	{
		$this->application->bind ( '', function ( ) { } );
	}

	/**
	 * @test
	 */
	public function bind_withStringValueForAbstract_registersAbstractInApplication ( )
	{
		$abstract = 'Engine';
		$concrete = function ( ) { };

		$this->container->shouldReceive ( 'set' )->once ( );
		$this->container->shouldReceive ( 'has' )->with ( $abstract )->once ( )->andReturn ( true );
		
		$this->application->bind ( $abstract, $concrete );
		$this->assertTrue ( $this->application->has ( $abstract ) );
	}

	/*
	|--------------------------------------------------------------------------
	| Make method testing
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 * @expectedException  InvalidArgumentException
	 * @dataProvider  nonStringValues
	 */
	public function make_withNonStringValueForAbstract_throwsException ( $value )
	{
		$this->application->make ( $value );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function make_withEmptyStringValueForAbstract_throwsException ( )
	{
		$this->application->make ( '' );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function make_withAbstractTypeThatIsNotRegistered_throwsException ( )
	{
		$nonRegisteredAbstract = 'non registered';
		$this->container->shouldReceive ( 'has' )->with ( $nonRegisteredAbstract )->once ( )->andReturn ( false );
		$this->application->make ( $nonRegisteredAbstract );
	}

	/*
	|--------------------------------------------------------------------------
	| Has method testing
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 * @expectedException  InvalidArgumentException
	 * @dataProvider  nonStringValues
	 */
	public function has_withNonStringValueForAbstract_throwsException ( $value )
	{
		$this->application->has ( $value, function ( ) { } );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function has_withEmptyStringValueForAbstract_throwsException ( )
	{
		$this->application->has ( '', function ( ) { } );
	}

	/*
	|--------------------------------------------------------------------------
	| Call method testing
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 */
	public function call_withClosureAndArguments_returnsClosureResults ( )
	{
		$greeting = 'hello';
		$closure = function ( $greeting ) { return $greeting; };
		$this->container->shouldReceive ( 'call' )->with ( $closure, array ( 'greeting' => $greeting ) )
			->once ( )->andReturn ( $greeting );
		$this->assertSame ( $greeting, $this->application->call ( $closure, array ( 'greeting' => $greeting ) ) );
	}
}