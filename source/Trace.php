<?php

namespace Foundation;

use Accessibility\Readable;

class Trace
{
	use Readable;
	
	private $file = '';
	private $line = 0;

	public function __construct ( array $data = array ( ) )
	{
		$this->file = $data [ 'file' ];
		$this->line = $data [ 'line' ];
	}
}