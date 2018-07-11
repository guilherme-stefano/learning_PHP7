<?php 

namespace Bookstore\Tests;

use PHPUnit_Framework_TestCase;
use InvalidArgumentException;

abstract class AbstractTestCase extends PHPUnit_Framework_TestCase {

	protected function mock(string $className)
	{
		if (strpos($className, '\\') !== 0) 
		{
			$className = '\\' . $className;
		}

		if(!class_exists($className)) {
			$className = '\Bookstore\\' . trim($className, '\\');
			
			if(!class_exists($className)) {
				throw new invalidArgumentException ("class $className not found.");
			}	
		}

		return $this->getMockBuilder($className)
			->disableOriginalConstructor()
			->getMock();
	}
}