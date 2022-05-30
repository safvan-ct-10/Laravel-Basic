<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
class Country extends Model
{
    use HasFactory, Cachable;
    protected $guarded;

    public function setCodeAttribute($value)
    {
        return $this->attributes['code'] = strtoupper($value);
    }
}
