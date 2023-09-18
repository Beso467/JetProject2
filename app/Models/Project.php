<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'projectname',
        'client_id',
        'contract_date',
        'contract_price',
        'expected_time',
        'contract_status',
        'total_price',
        'logo_path',
        'completion_date',
        'published',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
        
    }
    public function employees()
{
    return $this->belongsToMany(Employee::class)->withPivot('working_hours');
}

   
}

