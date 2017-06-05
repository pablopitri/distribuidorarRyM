<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = [
		'total', 'user_id'
	];

	public function getCreatedAtAttribute($value)
	{
		return \Carbon\Carbon::parse($value)->format('d-m-Y');
	}

  public function products(){
  	return $this->belongsToMany('App\Product')->withPivot('quantity', 'total');
  }

  public function user(){
  	return $this->belongsTo('App\User');
  }

  public function scopeCodigo($query, $codigo)
  {
  	if ($codigo != 'null')
  		$query->where('id', $codigo);
  }

  public function scopeFecha($query, $fecha)
  {
  	if ($fecha != 'null') {
  		$fecha = \Carbon\Carbon::parse($fecha)->format('Y-m-d');
  		$query->where('created_at', '>=', $fecha)
  					->orWhere('created_at', '<=', $fecha);
  	}
  }

  public function scopeVendedor($query, $vendedor)
  {
  	if ($vendedor != 'null') {
  		$query->whereHas('user', function($q) use ($vendedor){
  			$q->where('users.name', 'LIKE', "%$vendedor%")
  				->orWhere('users.last_name', 'LIKE', "%$vendedor%");
  		});
  	}
  }

}
