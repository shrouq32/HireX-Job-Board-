<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_description',
        'company_website',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function job()
    {
        return $this->hasMany(Job::class);
    }

   


}