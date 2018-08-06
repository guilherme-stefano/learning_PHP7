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

	protected function buildBook( array $properties): Book{
		$book = new Book();
		$reflectionClass = new ReflectionClass(Book::class);

		foreach ($properties as $key => $value) {
			$property = $reflectionClass->getProperty($key);
			$property->setAccessible(true);
			$property->setValue($book, $value);
		}
		return $book;
	}

	protected function addBook(array $params)
	{
		$default = [
			'id' => null,
			'isbn' => 'isbn',
			'title' => 'title',
			'author' => 'author',
			'stock' => 1,
			'price' => 10.0,
		];

		$params = array_merge($default, $params);

		$query = 'insert into book (id, isbn, title, author, stock, price)
		values (:id, :isbn, :title, :author, :stock, :price)';

		$this->db->prepare($query)->execute($params);
	}

		protected function addCustomer(array $params)
	{
		$default = [
			'id' => null,
			'firstname' => 'firstname',
			'surname' => 'surname',
			'email' => 'email',
			'type' => 'basic',
		];
		$params = array_merge($default, $params);

		$query = 'insert into customer (id, firstname, surname, email, type)
		values (:id, :firstname, :surname, :email, :type)';

		$this->db->prepare($query)->execute($params);
	}
}