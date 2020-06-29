<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('degrees')->insert([
            ['name' => 'Бакалавр'],
            ['name' => 'Специалист'],
            ['name' => 'Магистр'],
            ['name' => 'Аспирант'],
        ]);
    }
}
