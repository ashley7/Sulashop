<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $roles = ["admin",'store','buyer'];
        foreach ($roles as $key => $value) {
        	$save_role = new Role();
        	$save_role->name = $value;
        	try {
        		$save_role->save();
        	} catch (\Exception $e) {}
        }
    }
}
