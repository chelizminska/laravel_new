<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    public $fillable = ['title', 'description', 'content', 'is_imported', 'created_at'];
}
