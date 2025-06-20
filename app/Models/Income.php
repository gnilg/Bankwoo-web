<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    //
    protected $fillable = [
        'category_id',
        'amount',
        'description',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
