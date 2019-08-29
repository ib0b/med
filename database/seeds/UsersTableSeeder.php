<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $departments = ['reception','nursing','laboratory','radiology','treatment','optical'];
        foreach ($departments as $department) {
            User::create([
                "email"=> $department."@med.com",
                "department"=>"$department",
                "name"=>"John Doe",
                "password"=> Hash::make($department)
            ]);
        }


    }
}
