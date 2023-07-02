<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    // protected $foreignKey = 'school_id';
    protected $fillable = [
        'id',
        'title',
        'desc',
        'created_at',
        // 'nama', 
        'updated_at', 
    ];
}
