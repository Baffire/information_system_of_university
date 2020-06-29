<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            ['name' => 'Аспирант'],
            ['name' => 'Ассистент'],
            ['name' => 'Ведущий научный сотрудник'],
            ['name' => 'Главный научный сотрудник'],
            ['name' => 'Докторант'],
            ['name' => 'Доцент'],
            ['name' => 'Младший научный сотрудник'],
            ['name' => 'Научный сотрудник'],
            ['name' => 'Преподаватель'],
            ['name' => 'Профессор'],
            ['name' => 'Старший преподаватель'],
            ['name' => 'Старший научный сотрудник'],
        ]);
    }
}
