<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $guarded = [];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

}
