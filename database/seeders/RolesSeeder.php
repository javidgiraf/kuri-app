<?php



namespace Database\Seeders;



use Spatie\Permission\Models\Role;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()
    {
        $roles = ['superadmin', 'admin', 'customer'];

        foreach ($roles as $role) {
            Role::create([
                'name'       => $role,
                'guard_name' => 'web'
            ]);
        }
    }
}
