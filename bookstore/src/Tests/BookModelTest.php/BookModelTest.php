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

	/**
	* @expectedException \Bookstore\Exceptions\DbException
	*/

	public function testBorrowBookNotFound() {
		$book = $this->buildBook(['id' => 123]);
		$this->model->borrow($book, 123);
	}

	/**
	* @expectedException \Bookstore\Exceptions\DbException
	*/

	public function testBorrowCustomerNotFound() {
		$book = $this->buildBook(['id' => 123]);
		$this->addBook(['id' => 123]);

		$this->model->borrow($book, 123);
	}



}