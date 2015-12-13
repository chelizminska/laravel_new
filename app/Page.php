<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'content', 'is_sheet', 'parent_id', 'is_protected', 'child_amount', 'created_at'];
}
