<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Event extends Model
{
    use HasFactory, HasHashid, HashidRouting;

   	public function getHashidsConnection() 
    {	
    	return get_called_class();
    }

    /**
     * The roles that belong to the user.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Models\User', 'user_has_event')->withTimestamps();
    }

    public function scopeStartsAfterOrEqualNow($query)
    {
        return $query->where('starts_at', '>=', \Carbon\Carbon::today());
    }
}
