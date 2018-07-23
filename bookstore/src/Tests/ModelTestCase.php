<?php

namespace Bookstore\Tests;

use Bookstore\Core\Config;
use PDO;

abstract class ModelTestCase extends AbstractTesCase {
	protected $db;
	protected $tables = [];

	public function setUp()
	{
		$config = new Config();

		$dbConfig = $config->get('db');
		$this->db = new PDO(
			'mysql:host=127.0.0.1;dbname=bookstore',
			$dbConfig['user'],
			$dbConfig['password']);
		$this->db->beginTransaction();
		$this->cleanAllTables();
	}

	public function tearDown()
	{
		$this->db->rollBack();
	}

	protected function cleanAllTables()
	{
		foreach($this->tables as $table) {
			$this->db->exec("delete from $table");
		}
	}
}