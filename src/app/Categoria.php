<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{

    use SoftDeletes;

    // protected $dateFormat = 'U';
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    

}
