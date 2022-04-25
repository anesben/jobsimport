<?php
namespace App\Utils;

define('SQL_HOST', 'mariadb');
define('SQL_USER', 'root');
define('SQL_PWD', 'root');
define('SQL_DB', 'cmc_db');

use Exception; 
use PDO;

class DataBase
{
	private static	$instance = NULL;
	public			$db;

	private function  __construct()
	{
		try {
			$this->db = new PDO('mysql:host=' . SQL_HOST . ';dbname=' .
				SQL_DB, SQL_USER, SQL_PWD);
		} catch (Exception $e) {
			die('DB error: ' . $e->getMessage() . "\n");
		}
	}

	public static function getInstance()
	{
		if (self::$instance == NULL)
		{
			self::$instance = new Database();
		}
		return self::$instance;
	}
}