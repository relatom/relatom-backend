<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Comment extends Model
{

	use HasFactory, HasHashid, HashidRouting;

   	public function getHashidsConnection() 
    {	
    	return get_called_class();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'user_id', 'event_id'
    ];

    /**
     * The roles that belong to the user.
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    /**
     * The roles that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}