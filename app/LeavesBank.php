<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeavesBank extends Model
{
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['date','user_id','number_of_leaves'];
}
