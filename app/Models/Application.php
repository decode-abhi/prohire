<?php

namespace App\Models;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = [
        'job_id',
        'user_id',
        'cover_letter',
        'applicant_name',
        'email',
        'resume',
        'cover_letter',
        'status'
    ];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
