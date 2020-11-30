<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jackie Leonardy',
            'username' => 'mahlol24',
            'password' => bcrypt('password'),
            'email' => 'jackiezheng2024@gmail.com'
        ]);
    }
}
