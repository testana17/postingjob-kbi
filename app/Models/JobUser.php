<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JobUser extends Model
{
    use HasApiTokens, HasFactory, HasUuids;
    //
    protected $table = 'job_users';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'users_id',
        'judul',
        'deskripsi',
        'gaji',
        'kategori',
        'lokasi', 
        'type'
       ];

       public function user()
       {
           return $this->belongsTo(User::class);
       }

       public function applications()
       {
           return $this->hasMany(Application::class, 'job_id');
       }
   
       

}
