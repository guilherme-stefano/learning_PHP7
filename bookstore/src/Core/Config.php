<?php

namespace Bookstore\Core;

use Bookstore\Exceptions\NotFoundException;

class Config
{
	private static $data;
	private static $instance;

	private function __construct()
	{
		$json = file_get_contents(__DIR__. '/../config/app.json');
		self::$data = json_decode($json, true);
	}

	public static function getInstance(){
		if (self::$instance == null) {
			self::$instance = new Config();
		}
		return self::$instance;
	}

	public static function get($key)
	{
		if(!isset(self::$data[$key]))
		{
			throw new NotFoundException("Key $key not in config.");
		}
		return self::$data[$key];
	}
}