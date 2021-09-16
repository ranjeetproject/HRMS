<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeesExtraAndHalfDayLeavesDetail extends Model
{
    use SoftDeletes;

    protected $table = 'employees_extra_and_halfday_leaves_details';

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['employee_name','apply_date','extra_leaves','leaves','half_day_leaves','narration'];
}
