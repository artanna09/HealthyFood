<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consists extends Model
{
    //Table name
    protected $table = 'consists';
    //Primary Key
    public $primaryKey = 'id';

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
