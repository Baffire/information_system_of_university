<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DegreesTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(TrainingProgramsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(AcademicDegreesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
