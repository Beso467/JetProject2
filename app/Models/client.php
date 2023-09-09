<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = ['name', 'number', 'profile_picture_path'];

    public $timestamps = false; 
}
