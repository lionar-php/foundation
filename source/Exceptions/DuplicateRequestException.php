<?php

namespace Foundation\Exceptions;

use Exception;

class DuplicateRequestException extends Exception
{
	public function __construct ( string $request )
	{
		$this->message = "Request $request is already registered in the application.";
	}
}