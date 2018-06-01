<?php

namespace Bookstore\Domain;

interface Customer extends Payer {

	public static function getMonthlyFee(): float ;
	public function getAmountToBorrow(): int ;
	public function getType(): string ;
	
}
