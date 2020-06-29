<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Администратор',
                'slug' => '/admin',
            ],
            [
                'name' => 'Студент',
                'slug' => '/student',
            ],
            [
                'name' => 'Преподаватель',
                'slug' => '/teacher',
            ],
            [
                'name' => 'Сотрудник кафедры',
                'slug' => '/employee',
            ],
            [
                'name' => 'Заведующий кафедрой',
                'slug' => '/head',
            ],
        ]);
    }
}
