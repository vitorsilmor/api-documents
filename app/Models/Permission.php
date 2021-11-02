<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function profilePermissions()
    {
        return $this->hasMany(ProfilePermission::class, 'profile_permisson_id');
    }
}
