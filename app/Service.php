<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name'
    ];

    public function phone()
    {
        return $this->belongsToMany('App\Phone', 'service_phone')
                    ->withTimestamps();;
    }
}
