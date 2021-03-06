<?php

namespace Bookstore\Controllers;

use Bookstore\Core\Config;
use Bookstore\Core\Request;
use Bookstore\Utils\DependencyInjector;

abstract class AbstractController {
	protected $request;
	protected $di;
	protected $db;
	protected $config;
	protected $view;
	protected $log;
	protected $customerId;
	protected $session;

	public function __construct(DependencyInjector $di, Request $request) {
		$this->request = $request;
		$this->di = $di;
		$this->db = $di->get('PDO');
		$this->log = $di->get('Logger');
		$this->view = $di->get('Twig_Environment');
		$this->config =  $di->get('Utils\Config');
		$this->session = $di->get('Session');
		$this->customerId = $this->session->get($this->session->get('user'));

	}

	public function setCustomerId(int $customerId) {
		$this->customerId = $customerId;
	}

	protected function render(string $template, array $params): string {
		return $this->view->loadTemplate($template)->render($params);
	}
}