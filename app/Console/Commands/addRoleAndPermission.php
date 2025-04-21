<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class addRoleAndPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-role-and-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create permissions
        Permission::create(['name' => 'create post', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit post', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete post', 'guard_name' => 'api']);

        // Create roles
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $editor = Role::create(['name' => 'editor', 'guard_name' => 'api']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'api']);

        // Assign permissions to roles
        $admin->givePermissionTo(['create post', 'edit post', 'delete post']);
        $editor->givePermissionTo(['create post', 'edit post']);
        $user->givePermissionTo('create post');
    }
}
