<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Methods extends Model
{
    //Table name
    protected $table = 'methods';
    //Primary Key
    public $primaryKey = 'id';

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
