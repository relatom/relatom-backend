<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Organization extends Model
{
    use HasFactory, HasHashid, HashidRouting;

    public function getHashidsConnection() 
    {	
    	return get_called_class();
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function members()
    {
        return $this->hasMany('App\Models\Member');
    }
}
