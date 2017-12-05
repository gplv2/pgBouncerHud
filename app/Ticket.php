<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'category_id', 'id', 'dsn', 'description', 'label', 'priority'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
