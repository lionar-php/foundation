<?php

namespace Foundation\Exceptions;

use Exception;

class UnknownRequestException extends Exception
{
	public function __construct ( string $request )
	{
		$this->message = "A task for $request has not been registered in the application.";
	}
}