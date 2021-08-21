<?php

namespace App\Models;

use App\Models\JobDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = ['fname','lname','job_id','salay','contact_address','image'];
    protected $hidden = ['updated_at'];

    public function job_des()
    {
        return $this->belongsTo('App\Models\JobDescription','job_id');
    }

    public function getSalayAttribute($val)
    {
        return number_format($val);
    }
}
