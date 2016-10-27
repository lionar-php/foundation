<?php

namespace Foundation\Exceptions;

use Exception;

class InexistentDependencyException extends Exception
{
	public function __construct ( $abstract, $dependency )
	{
		parent::__construct ( "We could not resolve class: $dependency, when trying to make abstract type: $abstract." );
	}
}