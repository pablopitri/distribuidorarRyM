<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = [
		'total', 
	];

  public function products(){
  	return $this->belongsToMany('App\Product')->withPivot('quantity', 'total');
  }
}
