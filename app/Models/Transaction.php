<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'order_id', 'customer_name', 'customer_email',
         'customer_phone', 'total_price', 'status', 'snap_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relationship: Transaction has one review
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
