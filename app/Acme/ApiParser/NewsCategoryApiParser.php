<?php namespace Acme\ApiParser;

class NewsCategoryApiParser extends ApiParser 
{

	public function parse($newsCategory)
	{
		//common fields between methods in the news repos
		$output = [
			'id'   => $newsCategory['id'],
			'name' => $newsCategory['name'],
			'totalNews' => $newsCategory['nb_news']
		];

		return $output;
	}
	
}