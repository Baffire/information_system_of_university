@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список моих студентов
            </p>

            @if (count($students) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                            <th>#</th>
                            <th>Студент</th>
                            <th>Образовательная программа</th>
                            <th>Год поступления</th>
                            <th>Тема ВКР</th>
                            <th>Прогресс подготовки</th>
                            <th>Подробнее</th>
                        </thead>

                        <tbody>
                            @foreach( $students as $student )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $student->student->user->surname }}
                                        {{ $student->student->user->name }}
                                        {{ $student->student->user->patronymic }}
                                    </td>
                                    <td>{{ $student->student->training_program->name }}</td>
                                    <td class="text-center">{{ $student->student->year_of_admission }}</td>
                                    <td>
                                        @if( !empty($student->student->title_confirm->confirmation) && $student->student->title_confirm->confirmation == 1 )
                                            {{ $student->student->title_confirm->title->name }}
                                        @else
                                            Студент еще не выбрал тему
                                        @endif
                                    </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress_bar }}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>

                                    <td><a href="/teacher/my_students/progress/{{ $student->student->id }}" class="btn btn-success">Посмотреть</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {{ $students->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет студентов для дипломного руководства
                </div>
            @endif
        </div>
    </div>

@endsection
