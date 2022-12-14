<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        // Specifying table name because I actually mistyped the table name.
        // It was supposed to be permission_role to be defaulted xD
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
