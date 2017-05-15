<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = [
		'total', 'user_id'
	];

  public function products(){
  	return $this->belongsToMany('App\Product')->withPivot('quantity', 'total');
  }

  public function user(){
  	return $this->belongsTo('App\User');
  }

}
