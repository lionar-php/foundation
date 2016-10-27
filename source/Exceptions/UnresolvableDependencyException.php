<?php

namespace Foundation\Exceptions;

use Exception;

class UnresolvableDependencyException extends Exception
{
	public function __construct ( $abstract, $dependency, Trace $trace )
	{
		parent::__construct ( "We could not resolve class: $dependency, when trying to make abstract type: $abstract." );
	}
}