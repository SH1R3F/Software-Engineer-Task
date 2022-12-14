<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $list_user = Permission::create(['slug' => 'list-user']);
        $show_user = Permission::create(['slug' => 'show-user']);
        $create_user = Permission::create(['slug' => 'create-user']);
        $edit_user = Permission::create(['slug' => 'edit-user']);
        $delete_user = Permission::create(['slug' => 'delete-user']);
        $list_deleted_user = Permission::create(['slug' => 'list-deleted-user']);
        $restore_user = Permission::create(['slug' => 'restore-user']);
        $force_delete_user = Permission::create(['slug' => 'force-delete-user']);

        Role::where('name', 'Admin')->first()->permissions()->sync(Permission::all());
        Role::where('name', 'Employee')->first()->permissions()->sync([
            $list_user->id,
            $show_user->id,
            $create_user->id,
            $edit_user->id
        ]);
    }
}
