<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalMessage extends Model
{
    protected $fillable = ['source_user', 'destination_user', 'content', 'is_viewed'];
}
