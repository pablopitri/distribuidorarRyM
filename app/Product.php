<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name', 'price', 'category', 'type', 'image',
  ];

  public function sales(){
  	return $this->belongsToMany('App\Sale')->withPivot('quantity', 'total');
  }

  public function setNameAttribute($value)
  {
      $this->attributes['name'] = strtoupper($value);
  }

  public function setCategoryAttribute($value)
  {
      $this->attributes['category'] = strtoupper($value);
  }

  public function setTypeAttribute($value)
  {
      $this->attributes['type'] = strtoupper($value);
  }

  public function scopeCodigo($query, $cod){
    if($cod != 'null')
      $query->where('code', $cod);
  }

  public function scopeNombre($query, $nombre){
    if($nombre != 'null')
      $query->where('name', 'LIKE', "%$nombre%");
  }

  public function scopeCategoria($query, $categoria){
    if($categoria != 'null')
      $query->where('category', "$categoria");
  }
}
