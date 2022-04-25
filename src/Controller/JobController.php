<?php
namespace App\Controller;

use App\Model\Job;
use App\Repository\JobRepository;
use App\Utils\XmlHandler;
use Exception; 

class JobController
{
	private $managers;

	public function __construct()
	{
		$this->managers["jobs"] = new JobRepository();
		$this->xmlHandler = new XmlHandler();
	}

	public function import($directory) : int
	{
		$models = array();

		// Check if path is a valid directory.
		if (!is_dir($directory))
			throw new \Exception($directory . " is not a valid directory.");

		// Get all files in directory.
		$chdir = scandir($directory);
		foreach ($chdir as $key => $file)
		{
			if ($file != "." && $file != "..")
			{
                $method_name = $this->xmlHandler->methodName($file);
				// Call the method if it exists.
				if (method_exists($this->xmlHandler, $method_name))
					$models = array_merge($this->xmlHandler->$method_name($directory . "/" . $file), $models);
				else
					throw new \Exception("Unknown method in xmlHandler class: " . $method_name . ".");
			}
		}

		// Count jobs and add them on SQL database.
		$count = count($models);
		if ($count > 0)
		{
			$this->managers["jobs"]->delete();
			$this->managers["jobs"]->insertMultiple($models);
		}
		return ($this->managers["jobs"]->count());
	}

	public function fetch()
	{
		// Fetch all jobs from database.
		$jobs = $this->managers["jobs"]->getAll();
		return ($jobs);
	}
}
?>