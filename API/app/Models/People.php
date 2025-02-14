<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'people';

    public function investigation()
    {
        return $this->belongsTo(Investigation::class, 'case_id');
    }
}
