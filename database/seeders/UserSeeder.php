<?php



namespace Database\Seeders;



use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Spatie\Permission\Traits\HasRoles;



class UserSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run(): void
    {
        // Creating Super Admin User
        
        $superAdmin = User::create([
            'name'     => 'Super Admin',
            'email'    => 'kuriapp@admin.com',
            'password' => Hash::make('kuri@1234')
        ]);
        $superAdmin->assignRole('admin');
    }
}
