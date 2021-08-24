<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $fillable = ['type_id', 'images_id', 'status'];

    public function roomtype()
    {
        return $this->belongsTo('App\Models\Roomtype', 'type_id', 'id');
    }

    public function room_image()
    {
        return $this->belongsTo('App\Models\RoomImage', 'images_id', 'id');
    }

    public function getStatusAttribute($val)
    {
        switch ($val) {
            case 1:
                return  '<p class="text-danger"> not reservation </p>';
            case 2:
                return '<p class="text-success">reservation</P>';
            default:
                # code...
                break;
        }
    }
}
