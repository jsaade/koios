<?php
namespace Acme\Repositories;
use NewsCategory;

class DbNewsCategoryRepository extends DbRepos
{
	/**
	 * Get All the news categories of an application
	 * @param  Application $application 
	 * @return Array              
	 */
	public function getAll($application, $limit, $page)
	{
		$output = ['data' => [], 'pages' => []];

		if(!$limit) $limit = 25;
		if(!$page) $page = 1;

		$news_categories = NewsCategory::roots()->whereApplicationId($application->id)->paginate($limit);

		foreach($news_categories as $news_category)
		{
			$arr['id'] = $news_category->id;
			$arr['name'] = $news_category->name;
			$arr['nb_news'] = $news_category->news->count();
			$arr['children'] = $news_category->getRecursiveDescendants();
			array_push($output['data'], $arr);
		}
		
		$output['pages'] = $this->getApiPagerLinks($news_categories, 'api.news_category', [$application->api_key]);
		return $output;
	}

	/**
	 * Find a single news category
	 * @param  Integer $id 
	 * @return Array
	 */
	public function find($id)
	{
		$news_category = NewsCategory::findOrFail($id);

		$arr = array();
		$arr['id'] = $news_category->id;
		$arr['name'] = $news_category->name;
		$arr['nb_news'] = $news_category->news->count();

		return $arr;
	}


}