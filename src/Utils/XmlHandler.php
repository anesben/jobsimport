<?php 

namespace App\Utils;

use App\Model\Job;
use Exception; 

class XmlHandler
{
	function importFromJobteaserXML($filename) : array
	{
		$data = array();
		if (!file_exists($filename))
			throw new \Exception($filename . " is an invalid file.");
		$xml = simplexml_load_file($filename);
		foreach ($xml->offer as $item)
		{
			$data[] = new Job(
					addslashes($item->link), 
					addslashes($item->title),
					addslashes($item->description),
					addslashes($item->reference),
					addslashes($item->publisheddate),
					addslashes($item->companyname)
					);
		}
		return ($data);
	}

	function importFromRegionsjobXML($filename) : array
	{
		$data = array();
		if (!file_exists($filename))
			throw new \Exception($filename . " is an invalid file.");
		$xml = simplexml_load_file($filename);
		foreach ($xml->item as $item)
		{
			$data[] = new Job(
					addslashes($item->url), 
					addslashes($item->title),
					addslashes($item->description),
					addslashes($item->ref),
					addslashes($item->pubDate),
					addslashes($item->company)
					);

		}
		return ($data);
	}

	function methodName($file, $method_name = "importFrom", $format = "XML")
	{
		$values = explode(".", $file);
		$filename = ucfirst($values[0]);
		$format = strtoupper($values[1]);

		return $method_name . $filename . $format;
	}
}
?>