<?php

namespace App\Repository;

use App\Utils\DataBase;

abstract class AbstractRepository
{
	protected $dao;

	public function __construct()
	{
		$this->dao = DataBase::getInstance();
	}
}
?>