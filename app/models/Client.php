<?php

class Client extends \Eloquent {
	protected $table = 'client';
	protected $fillable = [];

	//Relationships
	public function applications()
	{
		return $this->hasMany('Application');
	}

	public function components()
	{
		return $this->belongsToMany('Component');
	}
}