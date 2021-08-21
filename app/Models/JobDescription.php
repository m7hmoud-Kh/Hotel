<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    use HasFactory;
    protected  $table = 'job_description';
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at'];


    public function employees()
    {
        return $this->hasMany('App\Models\Employees');
    }
}
