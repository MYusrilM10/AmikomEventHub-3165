<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{
    protected $fillable = ['name', 'popularity', 'created_at'];

    protected $dates = ['created_at', 'updated_at'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
