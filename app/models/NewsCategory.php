<?php

class NewsCategory extends Baum\Node {
	protected $table = 'news_category';
	protected $fillable = ['name', 'application_id', 'order'];
	//baum related 
	protected $scoped = array('application_id');
	protected $orderColumn = "order";

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function news()
	{
		return $this->hasMany('News');
	}

	public function application()
	{
		return $this->belongsTo('Application');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'name' => 'required',
		'application_id' => 'required|exists:application,id'
	];

	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);
		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}


	/***************
	 * NESTED SETS *
	 ***************/
	public function renderNode($news_category) 
	{
	  $data = [];
	  $data['category']    = $news_category;
	  $data['id']    = $news_category->id;
	  $data['name']  = $news_category->name;
	  $data['count'] = $count = $news_category->news->count();
	  $data['url']   = route('application.{application}.news.index', [$news_category->application->slug, 'category' => $news_category->id]);
	  $data['title'] = "This category has {$count} news.";
	 
	  echo "<li class='dd-item dd3-item' data-id='{$news_category->id}'>";
	  echo "<div class='dd-handle dd3-handle'>drag</div>";
	  echo "<div class='dd3-content'>".View::make('news_category.partials._list_row')->withData($data)->withApplication($news_category->application)->render()."</div>";

	  if ( !$news_category->isLeaf() > 0 ) {
	    echo "<ul class='dd-list'>";
	    	foreach($news_category->children as $child) $this->renderNode($child);
	    echo "</ul>";
	  }
	  echo "</li>";
	}


	public static function updateNestedSetOrder($arr)
	{
		foreach($arr as $key => $value)
		{
			$arr[$key]['order'] = $key;
			if(isset($arr[$key]['children']))
			{
				$arr[$key]['children'] = self::updateNestedSetOrder($arr[$key]['children']);
			}
		}
		return $arr;
	}


	/* used in the api news category */
	public function getRecursiveDescendants()
	{
	    $output = [];
	    $descendants = $this->getImmediateDescendants();

		foreach($descendants as $descendant)
		{
			$arr['id'] = $descendant->id;
			$arr['name'] = $descendant->name;
			$arr['nb_news'] = $descendant->news->count();
			$arr['children'] = $descendant->getRecursiveDescendants();
			array_push($output, $arr);
		}
		return $output;
	}

}