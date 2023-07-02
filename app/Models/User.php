<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    const ROLE_GURU = 'guru';
    const ROLE_ADMIN = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    // protected $foreignKey = 'school_id';
    protected $fillable = [
        'nip',
        'name',
        'email',
        'school_id',
        // 'latitude',
        // 'longitude',
        // 'radius',
        // 'nama',
        'password',
        'role_id',
        'remember_token',
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
        // return $this->belongsTo('App\Models\Sekolah', 'id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
        // return $this->belongsTo('App\Models\Sekolah', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
        // return $this->belongsTo('App\Models\Sekolah', 'id');
    }


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
}
