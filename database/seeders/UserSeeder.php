<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Saifuddin',
            'email' => 'saif@saif.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        User::factory(19)->create();
    }
}
