<?php

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
        factory(App\User::class, 30)->create();
        factory(App\User::class, 1)->create([
            'name' => 'Administrateur',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('root'),
            'isAdmin' => true,
        ]);
    }
}
