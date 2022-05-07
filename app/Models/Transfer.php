<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transfer extends Model
{
    use HasFactory;

    // protected $with = ['sender'] ;

    protected $fillable = [
        'user_from',
        'user_to',
        'amount',
        'created_at',
        'updated_at'
    ];

    // public function amount(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => "$ ".number_format($value / 100, 2),
    //         set: fn ($value) => $value * 100,
    //     );
    // }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_to');
    }
}
