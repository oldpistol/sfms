<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Johor'],
            ['name' => 'Kedah'],
            ['name' => 'Kelantan'],
            ['name' => 'Kuala Lumpur'],
            ['name' => 'Labuan'],
            ['name' => 'Melaka'],
            ['name' => 'Negeri Sembilan'],
            ['name' => 'Pahang'],
            ['name' => 'Perak'],
            ['name' => 'Perlis'],
            ['name' => 'Penang'],
            ['name' => 'Putrajaya'],
            ['name' => 'Sabah'],
            ['name' => 'Sarawak'],
            ['name' => 'Selangor'],
            ['name' => 'Terengganu'],
        ];

        State::insert($states);
    }
}
