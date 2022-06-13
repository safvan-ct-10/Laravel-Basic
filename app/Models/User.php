<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /*  protected $table
        IF TABLE OTHER THAN USERS THEN SPECIFY THAT FIELD
        EG:- protected $table = 'customers';
    */

    /*  protected $primaryKey
        IF PRIMARY KEY OTHER THAN ID FIELD THEN SPECIFY THAT FIELD
        EG:- protected $primaryKey = 'user_id';
    */

    // HIDE FIELDS FROM DISPLAYING NOT IN ACTIONS
    protected $hidden = ['id', 'password', 'remember_token'];

    // SPECIFY ALL FIELD CONTAIN DATE VALUE FOR APPLY CARBON FUNCTIONS
    protected $dates = ['dob'];

    // ALLOW MASS ASSIGNMENT
    //protected $fillable = ['name', 'email', 'password'];

    // ALLOW MASS ASSIGNMENT FOR ALL FIELDS
    protected $guarded;

    // GLOBAL SCOPE - WHERE CALL USER MODEL IT RETURN RESULTS WITH CHECKING GLOBAL SCOPES CONDITIONS
    // REMOVE GLOBAL SCOPE - WHEN CALL USER MODEL LIKE : User::withoutGlobalScope('active')->get();
    protected static function booted()
    {
        static::addGlobalScope('active', function ($user) {
            $user->where('is_active', 1);
        });
    }

    // LOCAL SCOPE
    // USE LIKE - User::>active()->get();
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // DYNAMIC SCOPE
    // USE LIKE - $users = User::ofActive(0)->get();
    public function scopeOfActive($query, $value)
    {
        return $query->where('is_active', $value);
    }

    // ACCESSOR - CHANGE DATA WHILE FECTHING
    // public function getDobAttribute($value)
    // {
    //     return date('d-M-y', strtotime($value));
    // }

    // START : CREATE NEW COLUNM TO TABLE
    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    public function getHumanDaysAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getActiveTextAttribute()
    {
        return $this->is_active == 1 ? 'ACTIVE' : 'IN ACTIVE';
    }

    protected $appends = ['active_text', 'age', 'human_days'];
    // END : CREATE NEW COLUNM TO TABLE

    // MUTATOR - CHANGE DATA BEFORE SAVING
    public function setDobAttribute($value)
    {
        return $this->attributes['dob'] = date('d-M-y', strtotime($value));
    }

    //HASONE RELATIONSHIP
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }





    // STUDY WHAT CAST
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
