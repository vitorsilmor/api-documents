<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = [
        'name', 'user_id'
    ];

    public function profilePermissions()
    {
        $this->hasMany(ProfilePermission::class, 'profile_id');
    }

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
