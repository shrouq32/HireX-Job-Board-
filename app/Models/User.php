<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role',
        'linkedin_id',
        'linkedin_token', 
        'avatar',
        'github_token', 
        'github_refresh_token', 
        'github_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Permission::class);
    }


    public function isEmployer(): bool
    {
        return $this->role->name === 'Employer';
    }

    /**
     * Check if the user is a Candidate.
     */
    public function isCandidate(): bool
    {
        return $this->role->name === 'Candidate';
    }
    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }
    /**
     * Check if the user is an Admin.
     */
    public function isAdmin(): bool
    {
        return $this->role->name === 'Admin';
    }
    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
