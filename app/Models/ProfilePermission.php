<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id', 'permission_id'
    ];

    public function profile()
    {
        $this->hasOne(Profile::class, 'profile_id');
    }

    public function permission()
    {
        $this->hasOne(Permission::class, 'permission_id');
    }
}
