<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'experience',
        'education',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
