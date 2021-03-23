<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TeamMember extends Model
{

    protected $hidden = ['created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['user_id','members'];

    public function users()
    {
        return $this->belongsTo('App\User','members');
    }
    
}
