<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $table = 'room_images';
    protected $fillable = ['filenames'];


    public function setFileNamesAttribute($val)
    {
        $this->attributes['filenames'] = json_encode($val);
    }

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }
}
