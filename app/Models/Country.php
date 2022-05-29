<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded;

    public function setCodeAttribute($value)
    {
        return $this->attributes['code'] = strtoupper($value);
    }
}
