<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'job_id',
        'status_id', 
        'resume',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the candidate that owns the application.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    
    /**
     * Get the job that the application is for.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the status of the application.
     */
    public function status()
    {
        return $this->belongsTo(ApplicationStatus::class, 'status_id');}

}
