<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';
    public $dateFormat = 'U';
    public $timestamps = true;
    protected $guarded = []; //不可以注入

}
