<?php

namespace Bookstore\Tests;

use Bookstore\Utils\DependencyInjector;
use Bookstore\Core\Config;
use Monolog\Logger;
use Bookstore\Core\Session;
use Bookstore\Core\MemorySessionAdapter;
use Twig_Environment;

use PDO;

abstract class ControllerTestCase extends AbstractTestCase {
	protected $di;

	public function setUp() {
		$this->di = new DependencyInjector();
		$this->di->set('PDO', $this->mock(PDO::class));
		$this->di->set('Utils\Config', $this->mock(Config::class));
		$this->di->set('Twig_Environment', $this->mock(Twig_Environment::class));
		$this->di->set('Logger', $this->mock(Logger::class));
		$session =  new Session();
		$session->init(new MemorySessionAdapter( ));
		$session->set('user', 1);
		$this->di->set('Session',$session);
				
	}
}