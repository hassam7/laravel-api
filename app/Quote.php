<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'quote_text','author_text'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
