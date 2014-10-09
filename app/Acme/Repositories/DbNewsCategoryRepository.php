<?php
namespace Acme\Repositories;
use NewsCategory;

class DbNewsCategoryRepository 
{
	/**
	 * Get All the news categories of an application
	 * @param  Application $application 
	 * @return Array              
	 */
	public function getAll($application)
	{
		$news_categories = $application->newsCategories;
		$output = [];
		foreach($news_categories as $news_category)
		{
			$arr['id'] = $news_category->id;
			$arr['name'] = $news_category->name;
			$arr['nb_news'] = $news_category->news->count();
			array_push($output, $arr);
		}
		return $output;
	}

	/**
	 * Get the news list of a news_category
	 * @param  NewsCategory $news_category 
	 * @return Array
	 */
	public function getNews($news_category)
	{
		$news = $news_category->news;
		$output = [];

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
}