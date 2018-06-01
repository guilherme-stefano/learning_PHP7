<?php

namespace Bookstore\Models;

use PDO;

abstract class AbstractModel {

	public function __construct(PDO $db) {
		$this->db = $db;
	}
}