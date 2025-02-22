<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Application extends Model
{
    //
    use HasApiTokens, HasFactory, HasUuids;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'job_id',
        'cv_path',
        'status',
        
       ];

       public function user()
       {
           return $this->belongsTo(User::class);
       }
    
       // Relasi ke tabel job_users
       public function job()
       {
           return $this->belongsTo(JobUser::class, 'job_id');
       }

}
