<?php

use Illuminate\Database\Seeder;

class AcademicDegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_degrees')->insert([
            ['name' => 'Кандидат технических наук'],
        ]);
    }
}
