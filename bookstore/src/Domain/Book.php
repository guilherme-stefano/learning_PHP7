<?php 

namespace Bookstore\Domain;

class Book {

	private $isbn;
	private $title;
	private $author;
	private $available;
	private $stock;
	private $price;

	public function getId(): int
	{
		return $this->isbn;
	}
	public function getIsbn(): int
	{
		return $this->isbn;
	}
	public function getTitle(): string
	{
		return $this->title;
	}
	public function getAuthor(): string
	{
		return $this->author;
	}
	
	public function getStock(): int
	{
		return $this->stock;
	}

	public function getCopy(): bool
	{
		if ($this->stock < 1) {
			return false;
		} else {
			$this->stock--;
			return true;
		}
	}

	public function addCopy()
	{
		$this->stock++;
	}

	public function getPrice(): float 
	{
		return $this->price;
	}


	public function isAvailable(): bool {
		return $this->available;
	}

	public function __toString(): string 
	{
		$result = '<i>' . $this->title . '</i> -' . $this->author;
		if(!$this->available) {
			$result .= ' <b>Not available</b>';
		}
		return $result;
	}

}

