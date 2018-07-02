<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\CustomerFactory;
use Bookstore\Domain\Customer\Basic;
use Bookstore\Domain\Sale;
use PHPUnit_Framework_TestCase;

class CustomerFactoryTest extends PHPUnit_Framework_TestCase
{

	public function testFactoryBasic()
	{
		$customer = CustomerFactory::factory('basic', 1, 'han', 'solo', 'han@solo.com');
		$this->assertInstanceOf(Basic::class, $customer, 'basic should create a Customer\Basic object.');

		$expectedBasicCustomer = new Basic(1, 'han', 'solo', 'han@solo.com');

		$this->assertEquals($customer, $expectedBasicCustomer, 
			'Customer object is not as expected');
	}

	public function testNewSaleHasNoBooks() 
	{
		$sale = new Sale();

		$this->assertEmpty(
			$sale->getBooks(),
			'When new , sale should have no books');
	}

	public function testAddNewBook() {
		$sale = new Sale();
		$sale->addBook(123);

		$this->assertCount(
			1,
			$sale->getBooks(),
			'Number of books not valid.'
			);

		$this->assertArrayHasKey(123, $sale->getBooks(),
			'Book id could not be fount in array.'
			);

		$this->assertSame(
			$sale->getBooks()[123],
			1,
			'When not specified, amount of books is 1.');

	}

	public function testAddMultipleBooks()
	{
		$sale = new Sale();
		$sale->addBook(123,4); 
		$sale->addBook(456,2); 
		$sale->addBook(456,8);

		$this->assertSame([123 => 4 , 456 => 10], $sale->getBooks(), 'Books are not as expected.'
			); 
	}

}