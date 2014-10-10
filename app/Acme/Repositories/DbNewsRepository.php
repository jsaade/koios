<?php
namespace Acme\Repositories;
use News;

class DbNewsRepository
{
	/**
	 * Get all the news of an application
	 * @param  Appliaction $application 
	 * @return Array
	 */
	public function getAll($application)
	{
		$output = array();
		$news = News::with('newsCategory')
				->where('application_id', $application->id)
				->get();

		foreach($news as $n)
		{
			$arr['id'] = $n->id;
			$arr['name'] = $n->name;
			$arr['category'] = $n->news_category->name;
			if($n->image)
				$arr['thumb'] = url($n->getImageThumbRelativeUrl());
			else
				$arr['thumb'] = null;
			array_push($output, $arr);
		}

		return $output;
	}


	/**
	 * Find a single news
	 * @param  Integer $id 
	 * @return Array
	 */
	public function find($id)
	{
		$n = News::findOrFail($id);
		$arr = array();
		$arr['id'] = $n->id;
		$arr['name'] = $n->name;
		$arr['description'] = $n->description;
		$arr['caption'] = $n->caption;
		if($n->image)
			$arr['image'] = url($n->getImageRelativeUrl());
		else
			$arr['image'] = null;
		$arr['category'] = $n->news_category->name;

		return $arr;
	}
}