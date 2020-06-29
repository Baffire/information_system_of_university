<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_programs')->insert([
            [
                'name' => 'Физика (профиль «Физика конденсированного состояния»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Электроника и наноэлектроника (профиль «Инжинириг аналоговых и цифровых сложно функциональных систем»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Электроэнергетика и электротехника (профиль «Электрооборудование и электрохозяйство предприятий, организации и учреждений»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Машиностроение (профиль «Оборудование и технология сварочного производства»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Материаловедение и технологии материалов (профиль «Материаловедение и технология материалов в твердотельной электронике»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Технология»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Педагогическое образование (с двумя профилями «Технология и физика»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Физика (профиль «Физика конденсированного состояния вещества»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Электроника и наноэлектроника (профиль «Промышленная электроника и микропроцессорная техника»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Материаловедение и технологии материалов (профиль «Материаловедение и технология наноматериалов и покрытий»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Физическое образование»)',
                'faculty_id' => 1,
            ],
            [
                'name' => 'Прикладная математика и информатика',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Информатика и вычислительная техника',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Информационные системы и технологии',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Информационная безопасность',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Педагогическое образование («Математика»)',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Педагогическое образование («Информатика»)',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Информационные системы и технологии (профиль «Управление данными»)',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Информационные системы и технологии (профиль «Прикладные информационные технологии»)',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Информатика, информационные технологии в образовании»)',
                'faculty_id' => 2,
            ],
            [
                'name' => 'Агрономия (профиль «Карантин и защита растений»)',
                'faculty_id' => 4,
            ],
            [
                'name' => 'Агроинженерия (профиль «Агромехатроника»)',
                'faculty_id' => 4,
            ],
            [
                'name' => 'Зоотехния (профиль «Бизнес-администрирование в зооветеринарии»)',
                'faculty_id' => 4,
            ],
            [
                'name' => 'Геология (профиль «Геология и геохимия нефти и газа»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'География (профиль «Страноведение и международный туризм»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'География (профиль «Ландшафтное планирование»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'Экология и природопользование (профиль «Природопользование»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'Экология и природопользование (профиль «Урбоэкология»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'Экология и природопользование (профиль «Природное и культурное наследие»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'Экология и природопользование (профиль «Геоэкология и экологическая безопасность»)',
                'faculty_id' => 5,
            ],
            [
                'name' => 'Химия (профиль «Зеленая химия»)',
                'faculty_id' => 6,
            ],
            [
                'name' => 'Химия (профиль «Нефтехимия»)',
                'faculty_id' => 6,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Химическое образование»)',
                'faculty_id' => 6,
            ],
            [
                'name' => 'Биология (профиль «Биоэкология»)',
                'faculty_id' => 7,
            ],
            [
                'name' => 'Биология (профиль «Медико-биологические науки»)',
                'faculty_id' => 7,
            ],
            [
                'name' => 'Биология (профиль «Гидробиология и аквакультура»)',
                'faculty_id' => 7,
            ],
            [
                'name' => 'Почвоведение (профиль «Земельный кадастр и сертификация почв»)',
                'faculty_id' => 7,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Биологическое образование»)',
                'faculty_id' => 7,
            ],
            [
                'name' => 'Психология (профиль «Организационная психология»)',
                'faculty_id' => 8,
            ],
            [
                'name' => 'Психолого-педагогическое образование (профиль «Практическая психология в образовании и социальной сфере»)',
                'faculty_id' => 8,
            ],
            [
                'name' => 'Психолого-педагогическое образование (профиль «Медиация в образовании и социальной сфере»)',
                'faculty_id' => 8,
            ],
            [
                'name' => 'Социальная работа (профиль «Экономика, право, организация и управление в социальной работе»)',
                'faculty_id' => 9,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Менеджмент в образовании»)',
                'faculty_id' => 9,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Начальное образование»)',
                'faculty_id' => 9,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Дошкольное образование»)',
                'faculty_id' => 9,
            ],
            [
                'name' => 'Психолого-педагогическое образование (профиль «Психология и социальная педагогика»)',
                'faculty_id' => 9,
            ],
            [
                'name' => 'Психолого-педагогическое образование (профиль «Специальная психология и педагогика: дефектология и логопедия»)',
                'faculty_id' => 9,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Теория физической культуры и технологии физического воспитания»)',
                'faculty_id' => 10,
            ],
            [
                'name' => 'Физическая культура для лиц с отклонениями в состоянии здоровья (адаптивная физическая культура) (профиль «Адаптивная физическая культура»)',
                'faculty_id' => 10,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Историческое образование»)',
                'faculty_id' => 11,
            ],
            [
                'name' => 'История (профиль «Отечественная история»)',
                'faculty_id' => 11,
            ],
            [
                'name' => 'Социология (профиль «Современные методы и технологии в изучении социальных проблем»)',
                'faculty_id' => 12,
            ],
            [
                'name' => 'Политология (профиль «Политическая культура и регионалистика»)',
                'faculty_id' => 12,
            ],
            [
                'name' => 'Философия (профиль «Социальная философия»)',
                'faculty_id' => 12,
            ],
            [
                'name' => 'Культурология (профиль «Культура массовых коммуникаций»)',
                'faculty_id' => 12,
            ],
            [
                'name' => 'Юриспруденция',
                'faculty_id' => 13,
            ],
            [
                'name' => 'Реклама и связи с общественностью (профиль «Связи с общественностью в сфере государственного и муниципального управления»)',
                'faculty_id' => 13,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Теория и практика преподавания иностранных языков»)',
                'faculty_id' => 14,
            ],
            [
                'name' => 'Лингвистика (профиль «Теория перевода, межкультурная/межъязыковая коммуникация, теория и практика перевода в профессиональной коммуникации»)',
                'faculty_id' => 14,
            ],
            [
                'name' => 'Педагогическое образование (профиль «Русский язык как иностранный»)',
                'faculty_id' => 15,
            ],
            [
                'name' => 'Журналистика (профиль «Язык и стиль СМИ»)',
                'faculty_id' => 15,
            ],
        ]);
    }
}
