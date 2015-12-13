<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumPageMessage extends Model
{
    public $fillable = ['content', 'page_id', 'page_title', 'user'];
}
