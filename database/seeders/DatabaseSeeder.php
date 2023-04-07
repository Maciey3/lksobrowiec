<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            'KS CHRZĄSZCZ CHRZĄSZCZYCE',
            'LZS ŻYWOCICE',
            'LZS INTER MECHNICA',
            'LKS OBROWIEC',
            'LZS ŁOWKOWICE',
            'LKS WIKING OPOLE',
            'LZS KOSMOS DOBRA',
            'LZS KÓRNICA-NOWY DWÓR',
            'MKS POLONIA II PRÓSZKÓW-PRZYSIECZ',
            'LZS DĄBRÓWKA GÓRNA',
            'KS GÓRAŻDŻE',
            'LKS GROSZMAL II OPOLE',
            'LZS II WALCE-KROMOŁÓW',
        ];
        
        foreach ($teams as $value) {
            Team::create([
                'name' => $value
            ]);
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
