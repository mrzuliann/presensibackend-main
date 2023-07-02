<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'latitude',
        'longitude',
        'radius',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','school_id','name');
        // return $this->hasMany('App\Models\User', 'sekolah_id');
    }



}
