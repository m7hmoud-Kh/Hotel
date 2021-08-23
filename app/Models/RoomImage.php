<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $table = 'room_images';
    protected $fillable = ['filenames'];


    public function setFilenamesAttribute($val)
    {
        $this->attributes['filenames'] = json_encode($val);
    }
}
