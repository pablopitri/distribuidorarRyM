<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pruduct extends Model
{
  protected $fillable = [
      'name', 'price', 'category', 'type', 'image',
  ];

  public function sales(){
  	return $this->belongsToMany('App\Sale')->withPivot('quantity', 'total');
  }
}
