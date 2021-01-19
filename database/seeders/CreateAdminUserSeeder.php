<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$user = User::create([
'user_fname' => 'mohamed',
'user_lname' => 'jemy',
'email' => 'admin@gmail.com',
'user_phone' => '01121564099',
'user_phoneOther' => '01006087523',
'user_nationalID' => '29703190102297',
'user_address1' => 'helwan',
'user_gender' => 'ذكر',
'user_jopName'=> "manager",
'password' => bcrypt('123456'),
'roles_name'=> ['owner'],
"status" => 'مفعل',
"section_id"=>'1',
"theme_mode"=>'0'
]);
$role = Role::create(['name' => 'owner']);
$permissions = Permission::pluck('id','id')->all();
$role->syncPermissions($permissions);
$user->assignRole([$role->id]);
}
}