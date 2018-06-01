<?php

namespace Bookstore\Domain;
use Bookstore\Utils\Unique;

class Person {
	use Unique;
	protected $email;
	protected $firstmane;
	protected $surname;

	public function __construct(
		int $id = null,
		string $firstname, 
		string $surname,
		string $email ) 
	{
		$this->email = $email;
		$this->firstname = $firstname; 
		$this->surname = $surname; 
		$this->setId($id);
	}

	public function getFirstname(): string {
		return $this->firstname;
	}

	public function getSurname(): string {
		return $this->surname;
	}

	public function getEmail(): string {
		return $this->email;
	}
	public function setEmail(string $email) {
		$this->email = $email;
	}
}