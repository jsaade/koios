<?php

class Answer extends \Eloquent {
	protected $fillable = ['description', 'is_correct'];
	protected $table = 'answer';

	public function question()
	{
		return $this->belongsTo('Question');
	}
}