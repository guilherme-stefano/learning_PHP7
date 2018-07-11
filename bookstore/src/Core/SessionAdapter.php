<?php 

namespace Bookstore\Core;

interface SessionAdapter
{
	public function get($var);
	public function set($var, $value);
}

