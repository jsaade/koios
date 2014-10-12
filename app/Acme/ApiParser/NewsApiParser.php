<?php namespace Acme\ApiParser;

class NewsApiParser extends ApiParser 
{

	public function parse($news)
	{
		//common fields between methods in the news repos
		$output = [
			'id'   => (int) $news['id'],
			'name' => $news['name'],
			'category' => $news['category'],
			'thumb' => $news['thumb']
		];

		if(array_key_exists('caption', $news))
			 $output['caption'] = $news['caption'];

		if(array_key_exists('image', $news))
			 $output['image'] = $news['image'];

		if(array_key_exists('description', $news))
	 		$output['description'] = $news['description'];

	 	if(array_key_exists('api_url', $news))
	 		$output['url'] = $news['api_url'];

		return $output;
	}
	
}

