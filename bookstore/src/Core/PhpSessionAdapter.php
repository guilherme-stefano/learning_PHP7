<?php

namespace Bookstore\Core;

class PhpSessionAdapter implements SessionAdapter
{
	public function get($var)
	{
		return isset($_SESSION[$var]) ? $SESSION[$var]: null;
	}

	public function set($var, $value)
	{
		$_SESSION[$var] = $value;
	}
}