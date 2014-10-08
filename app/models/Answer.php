<?php

class Answer extends \Eloquent {
	protected $fillable = ['description', 'is_correct', 'question_id'];
	protected $table = 'answer';
}