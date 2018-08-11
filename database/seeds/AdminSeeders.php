<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $pro=new User();

        $pro->name='shuti';
        $pro->email='admin@admin.com';
        $pro->password=bcrypt('1q2w3e4r5t');

        $pro->save();
    }
}
