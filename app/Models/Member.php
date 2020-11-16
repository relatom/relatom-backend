<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Member extends Model
{
    use HasFactory, HasHashid, HashidRouting, Notifiable;

    public function getHashidsConnection() 
    {	
    	return get_called_class();
    }

    public function scopeParents(Builder $builder)
    {
    	$builder->whereNull('parent_id');
    }

    public function children() 
    {
    	return $this->hasMany(Member::class, 'parent_id', 'id');
    }

    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getFullnameShortAttribute()
    {
        $firsLetter = substr($this->lastname, 0, 1);
        return "{$this->firstname} {$firsLetter}.";
    }
}
