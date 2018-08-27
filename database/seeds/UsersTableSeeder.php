<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
 
        $saveuser=new User();
        $saveuser->name = "SulaShop Admin";
        $saveuser->email = "admin@sulashop.com";
        $saveuser->password = bcrypt("password@");      
        $saveuser->phone_number = "+256787444081";      
        $saveuser->remember_token = str_random(32);
        try {
        	$saveuser->save();
	        try {
	            $readrole_id = \DB::table('roles')->where('name','admin')->select('id')->first();
	            \DB::table('role_user')->insert([['user_id' =>  $saveuser->id, 'role_id' =>  $readrole_id->id],]);            
	        } catch (\Exception $e) {
	            echo $e->getMessage();
	        }
        	
        } catch (\Exception $e) {
        	echo $e->getMessage();
        }
    }
}
