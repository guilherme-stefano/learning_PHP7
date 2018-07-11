<?php

namespace Bookstore\Tests\Controllers;

use Bookstore\Controllers\BookController;
use Bookstore\Core\Request;
use Bookstore\Exceptions\NotFoundException;
use Bookstore\Models\BookModel;
use Bookstore\Tests\ControllerTestCase;
use Twig_Template;

class BookControllerTest extends ControllerTestCase {
	
	private function getController(
		Request $request = null 
		) : BookController 
	{
		if ($request === null) {
			$request = $this->mock('Core\Request');

		}
		return new BookController($this->di, $request);
	}

	public function testBookNotFound()
	{
		$bookModel = $this->mock(BookModel::class);

		$bookModel
			->expects($this->once())
			->method('get')
			->with(123)
			->will(
				$this->throwException(
					new NotFoundException()
					)
				);
			$this->di->set('BookModel', $bookModel);

			$response = "BookModel template";
			$template = $this->mock(Twig_Template::class);
			$template
				->expects($this->once())
				->method('render')
				->with(['errorMessage' => ' Book not found.'])
				->will($this->returnValue($response));
			$this->di->get('Twig_Environment')
				->expects($this->once())
				->method('loadTemplate')
				->with('error.twig')
				->will($this->returnValue($template));

		$result = $this->getController()->borrow(123);

		$this->assertSame(
			$result,
			$response,
			'Response Object is not expected onde.'
		);
	} 

	// protected function mockTemplate(
	// 	string $templateName,
	// 	array $params,
	// 	$response 
	// ) {
	// 	return 
	// }
}