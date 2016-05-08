<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Models\User::class)->create([
            'name' => 'user',
            'email' => 'user@app.dev',
            'password' => bcrypt('password'),
        ]);

        factory(App\Models\User::class)->create([
            'name' => 'mastermind',
            'email' => 'mastermind@app.dev',
            'password' => bcrypt('password'),
            'is_mastermind' => true,
        ]);
    }
}
