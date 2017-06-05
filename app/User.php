<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'last_name', 'rol', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sales(){
        return $this->hasMany('App\Sale');
    }

    public function setNameAttribute($value)
    {
      $this->attributes['name'] = ucwords(strtolower($value));
    }

    public function setLastNameAttribute($value)
    {
      $this->attributes['last_name'] = ucwords(strtolower($value));
    }

    public function setUsernameAttribute($value)
    {
      $this->attributes['username'] = strtolower($value);
    }

    public function fullName()
    {
        return $this->name.' '.$this->last_name;
    }

    public function rol()
    {
        return $this->rol;
    }

    public function isAdmin(){
      return ($this->rol == 'administrador') ? true : false;
    }

    public function scopeNombre($query, $nombre){
      if($nombre != 'null')
      {
        $query->where('name', 'LIKE', "%$nombre%")->orWhere('last_name', 'LIKE', "%$nombre%");
      }
    }

    public function scopeEmail($query, $email){
      if($email != 'null')
        $query->where('email', 'LIKE', "%$email%");
    }

    public function scopePrivilegio($query, $priv){
      if($priv != 'null')
        $query->where('rol', $priv);
    }
}
