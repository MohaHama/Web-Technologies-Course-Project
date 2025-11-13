<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //This is a model and its used to "represent" the data in the databse. It can be used to manipulate the data
    protected $fillable = [
        'event',
        'description',
        'location',
        'date',
        'price',
        'available_seats',
        'host_id'
    ];

    //Method to call the host id for the events host user
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}
