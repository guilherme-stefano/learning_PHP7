<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\Basic;
use PHPUnit_Framework_TestCase;

class BasicTest extends PHPUnit_Framework_TestCase {

	private $customer;

	public function setUp() {
		$this->customer = new Basic(1, 'han' , 'solo' , 'han@solo.com');
	}

	public function testAmountToBorrow() {

		$this->assertSame(3, $this->customer->getAmountToBorrow(), 'Basic customer should borrow up to 3 books.' ) ; 
	}

	public function testFail() {

		$this->assertSame(4,  $this->customer->getAmountToBorrow(), 'Basic customer should borrow up to 3 books.');
	}

	public function testIsExtentOfTaxes()
	{
		$this->assertFalse(
			$this->customer->isExtentOfTaxes(),
			'Basic customer should be exempt of taxes.'
			);
	}

	public function testGetMonthlyFee() 
	{
		$this->assertEquals(
			5,
			$this->customer->getMonthlyFee(),
			'Basic customer should pay 5 a month');
	}
}