<?php namespace Acme\ApiParser;

class NewsCategoryApiParser extends ApiParser 
{

	public function parse($newsCategory)
	{
		//common fields between methods in the news repos
		$output = [
			'id'   => (int) $newsCategory['id'],
			'name' => $newsCategory['name'],
			'totalNews' => $newsCategory['nb_news'],
			'children' => $newsCategory['children']
		];

		return $output;
	}
	
}