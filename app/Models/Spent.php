<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spent extends Model
{
    //
    protected $fillable = [
        'category_id',
        'amount',
        'description',
        'date',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
