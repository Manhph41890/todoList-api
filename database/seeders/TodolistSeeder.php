<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = Faker::create();
        for($i = 0; $i < 5; $i++) {
            DB::table('todolist')->insert([
                'title' => $fake->sentence(3),
                'description' => $fake->paragraph(),
                'due_date' => $fake->dateBetween('now', '+1 year'),
                'piority' => $fake->randomElement(['high', 'normal', 'low'])
            ]);
    }
}
}
