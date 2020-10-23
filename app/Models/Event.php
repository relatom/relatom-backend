<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function scopeStartsAfterOrEqualNow($query)
    {
        return $query->where('starts_at', '>=', \Carbon\Carbon::today());
    }
}
