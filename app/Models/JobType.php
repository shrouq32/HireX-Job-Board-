<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'job_type';

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type'); 
    }
}
