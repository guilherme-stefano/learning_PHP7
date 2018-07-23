<?php

namespace Bookstore\Tests\Models;

use Bookstore\Models\BookModel;
use Bookstore\Tests\ModelTestCase;

class BookModelTest extends ModelTestCase {
	protected $tables = [
		'borrowed_books',
		'customer',
		'book'
	];

	protected $model;

	public function setUp() {
		parent::setUp();

		$this->model = new BookModel($this->db);
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

}