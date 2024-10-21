<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    use HasFactory;
    protected $table = 'application_status'; 
   
    protected $primaryKey = 'id';

 
    protected $fillable = [
        'name',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'status_id');
    }
}
