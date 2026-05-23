<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'popularity', 'created_at'];

    protected $dates = ['created_at', 'updated_at'];

    // Auto-generate slug from name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
