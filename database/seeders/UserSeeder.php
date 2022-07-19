<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            "name"=>"htet shine htwe",
            "email"=>"htetshine.htetmkk@gmail.com",
            'role'=>'admin',
            "password"=>Hash::make('asdffdsa')
        ]);

        User::factory()->create([
            "name"=>"Test editor",
            "email"=>"testeditor@gmail.com",
            'role'=>'editor',
            "password"=>Hash::make('asdffdsa')
        ]);

        User::factory()->create([
            "name"=>"Test author",
            "email"=>"testauthor@gmail.com",
            'role'=>'author',
            "password"=>Hash::make('asdffdsa')
        ]);

        User::factory(10)->create();
    }
}
