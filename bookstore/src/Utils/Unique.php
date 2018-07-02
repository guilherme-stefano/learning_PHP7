<?php 

namespace Bookstore\Utils;

use Bookstore\Exceptions\InvalidIdException;
use Bookstore\Exceptions\ExceededMaxAllowedException;

trait Unique {
	protected $id;

	public function setId(int $id = null)
	{
		$this->id = $id;
	}

	public function getId(): int {
		return $this->id;
	}
}