<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SalarySetUp extends Model
{
    use SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['recruitment_id','employee_details_id','name_of_candidate','employee_code','email_id','salary_type','gross_salary','ctc','basic','hra','other_allowances','epf','esi','p_tax','tds'];

    public function recruitment()
    {
        return $this->belongsTo('App\Recruitment','recruitment_id');
    }

}
