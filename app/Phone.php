<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'msisdn'
    ];

    public function service()
    {
        return $this->belongsToMany('App\Service', 'service_phone')
                    ->withTimestamps();
    }
    public function get_services()
    {
        $this->services = $this->service()->get();
    }
}
