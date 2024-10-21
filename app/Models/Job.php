<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'category_id',
        'job_status',
        'job_type',
        'responsibilities',
        'emp_id',
        'salary',
        'benefits',
        'deadline',
        'logo',
    ];


    public function employer()
    {
        return $this->belongsTo(Employer::class, 'emp_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function status()
    {
        return $this->belongsTo(JobStatus::class, 'job_status');
    }
    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
