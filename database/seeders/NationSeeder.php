<?php

namespace Database\Seeders;

use App\Models\Nation;
use Illuminate\Database\Seeder;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nations = ['Myanmar','Usa','China','Thailand','Japan'];
        foreach($nations as $nation){
           Nation::factory()->create([
            'name'=>$nation
           ]);
        }
    }
}
