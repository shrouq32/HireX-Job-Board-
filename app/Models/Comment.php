<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'user_id',
        'comment',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'emp_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
