<?php

class Component extends \Eloquent {
	protected $table = 'component';
	protected $fillable = [];

	//Relationships
	public function applications()
	{
		return $this->belongsToMany('Application');
	}
}