<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roomtype extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'roomtypes';
    protected $fillable = ['type','description','price'];

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function changeFormatPrice()
    {
        return  '$ ' .number_format($this->price,2) ;
    }

}
