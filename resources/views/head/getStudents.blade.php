@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <div class="text-center mt-3">
                <p class="h4">
                    Список студентов
                </p>
                <p class="h5">
                    обучающихся по образовательной программе "{{ $training_program }}"
                </p>
                <p class="h5">
                    год поступления {{ $year }}
                </p>
                <div class="h5">
                <span>
                    ( {{ $degree }} )
                </span>
                </div>
            </div>

            @if(count($students) != 0)
                <div class="text-center mt-4 mb-2">
                    <form action="" method="POST">
                        @csrf
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="created_at" name="sort" class="custom-control-input" value="created_at">
                            <label class="custom-control-label" for="created_at">Дата добавления</label>
                        </div>
                        <div class="text-center mt-3">
                            <input type="submit" class="btn btn-secondary" value="Сортировать">
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>E-mail</th>
                                <th>Тема ВКР</th>
                                <th>Научный руководитель</th>
                                <th>Дополнительный руководитель</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $students as $student )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $student->user->surname }}
                                        {{ $student->user->name }}
                                        {{ $student->user->patronymic }}
                                    </td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->title_confirm->title->name ?? '' }}</td>
                                    <td>
                                        @if ( !empty($student->title_confirm->teacher) )
                                            {{ $student->title_confirm->teacher->user->surname ?? '' }}
                                            {{ $student->title_confirm->teacher->user->name ?? '' }}
                                            {{ $student->title_confirm->teacher->user->patronymic ?? '' }}
                                            <br>
                                            <b>Академическая степень</b>
                                            {{ $student->title_confirm->teacher->academic_degree->name ?? '' }}
                                            <br>
                                            <b>Звание</b>
                                            {{ $student->title_confirm->teacher->status->name ?? '' }}
                                            <br>
                                            <b>Должность</b>
                                            {{ $student->title_confirm->teacher->post->name ?? '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ( !empty($student->title_confirm->add_teacher) )
                                            {{ $student->title_confirm->add_teacher->teacher->user->surname ?? '' }}
                                            {{ $student->title_confirm->add_teacher->teacher->user->name ?? '' }}
                                            {{ $student->title_confirm->add_teacher->teacher->user->patronymic ?? '' }}
                                            <br>
                                            <b>Академическая степень</b>
                                            {{ $student->title_confirm->add_teacher->teacher->academic_degree->name ?? '' }}
                                            <br>
                                            <b>Звание</b>
                                            {{ $student->title_confirm->add_teacher->teacher->status->name ?? '' }}
                                            <br>
                                            <b>Должность</b>
                                            {{ $student->title_confirm->add_teacher->teacher->post->name ?? '' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $students->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет пользователей.
                </div>
            @endif
        </div>
    </div>

@endsection
