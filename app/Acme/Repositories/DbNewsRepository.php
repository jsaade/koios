<?php
namespace Acme\Repositories;
use News;

class DbNewsRepository extends DbRepos
{
	/**
	 * Get all the news of an application
	 * @param  Appliaction $application 
	 * @return Array
	 */
	public function getAll($application, $limit, $page, $category_id = null)
	{
		$output = ['data' => [], 'pages' => []];
		
		if(!$limit) $limit = 25;
		if(!$page) $page = 1;

		$news = News::with('newsCategory')->where('application_id', $application->id);
		if($category_id)
			$news = $news->where('news_category_id', $category_id);

		$news = $news->paginate($limit);

		foreach($news as $n)
		{
			$arr['id'] 		 = $n->id;
			$arr['name'] 	 = $n->name;
			$arr['category'] = $n->news_category->name;
			$arr['thumb']    = $n->getImageThumbFullUrl();
			$arr['api_url']  = route('api.news.show', [$application->api_key, $n->id]);
			array_push($output['data'], $arr);
		}

		$output['pages'] = $this->getApiPagerLinks($news, 'api.news', [$application->api_key]);

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
		$arr['id'] 			= $n->id;
		$arr['name'] 		= $n->name;
		$arr['description'] = $n->description;
		$arr['caption'] 	= $n->caption;
		$arr['category'] 	= $n->news_category->name;
		$arr['image'] 		= $n->getImageFullUrl();
		$arr['thumb'] 		= $n->getImageThumbFullUrl();

		return $arr;
	}
}