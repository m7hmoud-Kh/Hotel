<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    use HasFactory;
    protected $table = 'roomtypes';
    protected $fillable = ['type','description'];

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }
}
