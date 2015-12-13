<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    protected $fillable = array('id', 'title', 'content');
    public $timestamps = false;
    public $table = 'fishes';
}
