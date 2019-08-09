<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['query', 'searched_at'];
    protected $dates = ['searched_at'];
}
