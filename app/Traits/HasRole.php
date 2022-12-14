<?php


namespace App\Traits;

use App\Models\Permission;

trait HasRole
{

    public function hasRole($roles)
    {

        // If user has no role don't continue. ده يوزر عادي فقير غلبان
        if (!$this->role) return false;

        // I can receive it as array or as string like Admin,Employee
        if (!is_array($roles)) $roles = explode(',', $roles);

        foreach ($roles as $role) {
            if ($this->role->name === $role) return true;
        }
        return false;
    }

    public function hasPermission($permission)
    {
        if (!$this->role) return false;

        return (bool) $this->role->permissions()->where('slug', $permission)->count();
    }
}
