<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    protected $table = 'cases';

    public function investigator()
    {
        return $this->belongsTo(People::class, 'investigator_id');
    }

    public function witnesses()
    {
        return $this->hasMany(Witness::class, 'case_id');
    }

    public function people() {
        return $this->hasMany(People::class, 'case_id');
    }
}
