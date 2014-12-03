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
	public function renderNode($node) 
	{
	  $data = [];
	  $data['category']    = $node;
	  $data['id']    = $node->id;
	  $data['name']  = $node->name;
	  $data['count'] = $count = $node->news->count();
	  $data['url']   = route('application.{application}.news.index', [$node->application->slug, 'category' => $node->id]);
	  $data['title'] = "This category has {$count} news.";
	 
	  echo "<li class='dd-item dd3-item' data-id='{$node->id}'>";
	  echo "<div class='dd-handle dd3-handle'>drag</div>";
	  echo "<div class='dd3-content'>".View::make('news_category.partials._list_row')->withData($data)->withApplication($node->application)->render()."</div>";

	  if ( $node->children()->count() > 0 ) {
	    echo "<ul class='dd-list'>";
	    	foreach($node->children as $child) $this->renderNode($child);
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



}