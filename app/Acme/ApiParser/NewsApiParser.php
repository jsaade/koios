<?php namespace Acme\ApiParser;

class NewsApiParser extends ApiParser 
{

	public function parse($news)
	{
		$output = [];

		if(array_key_exists('id', $news))
			 $output['id'] = (int) $news['id'];

		if(array_key_exists('name', $news))
			 $output['name'] = $news['name'];

		if(array_key_exists('category', $news))
			 $output['category'] = $news['category'];
			 
		if(array_key_exists('created_at', $news))
			 $output['date'] = $news['created_at']->format('F j, Y');		 	

		if(array_key_exists('caption', $news))
			 $output['caption'] = $news['caption'];

		if(array_key_exists('image', $news))
			 $output['image'] = $news['image'];

		if(array_key_exists('thumb', $news))
			 $output['thumb'] = $news['thumb'];

		if(array_key_exists('description', $news))
	 		$output['description'] = $news['description'];

	 	if(array_key_exists('api_url', $news))
	 		$output['url'] = $news['api_url'];

		return $output;
	}
	
}

