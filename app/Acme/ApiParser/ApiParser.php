<?php namespace Acme\ApiParser; 


abstract class ApiParser
{
	
	public function parseCollection(array $collection)
	{
		//echo "<pre>".print_r($collection, true)."</pre>";dd();
		
		$data  =  array_map( [$this, 'parse'], $collection['data']);
		$pages =  $collection['pages'];

		return ['data' => $data, 'pages' => $pages];
	}

	public abstract function parse($item);
}