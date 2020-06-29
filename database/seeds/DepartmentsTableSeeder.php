<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'name' => 'Кафедра прикладной математики и информатики',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Кафедра информационных технологий',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Кафедра информационной безопасности',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Кафедра теоретической физики и методики преподавания физики',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Кафедра общей физики',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Кафедра материаловедения и технологии сварки',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Кафедра электротехники, электроники и автоматики',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Кафедра математики и методики её преподавания',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Кафедра дизайна',
                'faculty_id' => 3,
            ],
            [
                'name' => 'Кафедра архитектуры',
                'faculty_id' => 3,
            ],
        ]);
    }
}
