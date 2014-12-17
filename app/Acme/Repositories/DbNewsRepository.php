<?php
namespace Acme\Repositories;
use News;
use newsCategory;

class DbNewsRepository extends DbRepos
{
	/**
	 * Get all the news of an application
	 * @param  Appliaction $application 
	 * @return Array
	 */
	public function getAll($application, $limit, $page, $category_id = null, $return = "array", $fields=null)
	{
		$output = ['data' => [], 'pages' => []];
		$cat_ids = [];

		if(!$limit) $limit = 25;
		if(!$page) $page = 1;
		if(!$fields) $fields='id,name,category,thumb,caption,created_at,api_url';

		$news = News::with('newsCategory')->where('application_id', $application->id);
		
		if($category_id)
		{
			array_push($cat_ids, $category_id);
			$news_category = NewsCategory::findOrFail($category_id);
			$descendants = $news_category->getDescendants();
			if($descendants->count())
			{
				foreach($descendants as $descendant)
					array_push($cat_ids, $descendant->id);
			}
			$news = $news->whereIn('news_category_id',  $cat_ids);
		}

		$news = $news->orderBy('created_at', 'desc');
		$news = $news->paginate($limit);
		
		if($return == "object")
			return $news;

		foreach($news as $n)
		{
			//get all fields from db 
			$arr['id'] 		    = $n->id;
			$arr['name'] 	    = $n->name;
			$arr['category']    = $n->news_category->name;
			$arr['caption'] 	= $n->caption;
			$arr['description'] = $n->description;
			$arr['thumb']       = $n->getImageThumbFullUrl();
			$arr['image']       = $n->getImageFullUrl();
			$arr['created_at']  = $n->created_at;
			$arr['api_url']     = route('api.news.show', [$application->api_key, $n->id]);

			//check with fields 
			$fields_arr = explode(",", $fields);
			$fields_arr = array_flip($fields_arr);
			$arr = array_intersect_key($arr, $fields_arr);

			dd($arr);
			array_push($output['data'], $arr);
		}

		if($category_id)
		{
			$routeName = 'api.news.category';
			$routeParams = [$application->api_key, $category_id];
		}
		else 
		{
			$routeName = 'api.news';
			$routeParams= [$application->api_key];
		}

		$output['pages'] = $this->getApiPagerLinks($news, $routeName, $routeParams);

		return $output;
	}


	/**
	 * Find a single news
	 * @param  Integer $id 
	 * @return Array
	 */
	public function find($id, $return = "array")
	{
		$n = News::findOrFail($id);

		if($return == "object")
			return $n;

		$arr = array();
		$arr['id'] 			= $n->id;
		$arr['name'] 		= $n->name;
		$arr['description'] = $n->description;
		$arr['caption'] 	= $n->caption;
		$arr['created_at']  = $n->created_at;
		$arr['category'] 	= $n->news_category->name;
		$arr['image'] 		= $n->getImageFullUrl();
		$arr['thumb'] 		= $n->getImageThumbFullUrl();

		return $arr;
	}
}