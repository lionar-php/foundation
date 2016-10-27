<?php

namespace Foundation;

use Accessibility\Readable;

class Trace
{
	use Readable;
	
	private $file, $abstract = '';
	private $line = 0;

	public function __construct ( array $data = array ( ), $abstract )
	{
		$this->file = $data [ 'file' ];
		$this->line = $data [ 'line' ];
		$this->abstract = $abstract;
	}
}