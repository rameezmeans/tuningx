<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'language',
        'address',
        'zip',
        'city',
        'country',
        'status',
        'company_name',
        'company_id',
        'slave_tools_flag',
        'master_tools',
        'slave_tools',
        'front_end_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function credits(){
        return $this->hasMany(Credit::class); 
    }

    public function total_credits(){
        return Credit::where('user_id', '=', $this->id)->sum('credits');
    }

    public function translation(){
        return $this->hasOne(Translation::class);
    }

    public function group(){
        return $this->belongsTo(Group::class); 
    }
}
