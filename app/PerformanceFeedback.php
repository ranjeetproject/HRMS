<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PerformanceFeedback extends Model
{
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['team_member_name_id','performance_type','review_date','description'];
}
