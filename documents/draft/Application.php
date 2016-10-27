<?php

namespace Foundation;

use DI\ContainerBuilder;

class Application
{
	private $traces = array ( );

	public function bind ( $abstract, $concrete )
	{
		$this->traces [ ] = new Trace ( array_pop ( debug_backtrace ( ) ) );
	}
}