@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Закрепленные темы ВКР и руководители
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }}" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if (count($titles) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead class="border-bottom">
                            <th>#</th>
                            <th class="p-1">Руководитель</th>
                            <th class="p-1">Дополнительный руководитель</th>
                            <th class="p-1">Тема выпускной квалификационной работы</th>
                            <th class="p-1">Описание</th>
                            <th class="p-1">Программное обеспечение</th>
                            <th class="p-1 text-center">Действие</th>
                        </thead>
                        <tbody>
                        @foreach( $titles as $title )
                            <tr>
                                <tr class="table-danger">
                                    <td colspan="11">
                                        <b>Студент: </b>
                                        {{ $title->student->user->surname }}
                                        {{ $title->student->user->name }}
                                        {{ $title->student->user->patronymic }}
                                        <b>Образовательная программа: </b>
                                        {{ $title->student->training_program->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="text-center">{{ $loop->iteration }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $title->teacher->user->surname }}
                                        {{ $title->teacher->user->name }}
                                        {{ $title->teacher->user->patronymic ?? '' }}
                                        <br>
                                        <b>Академическая степень: </b> {{ $title->teacher->academic_degree->name ?? 'Нет' }}
                                        <br>
                                        <b>Академическое звание: </b> {{ $title->teacher->status->name ?? 'Нет' }}
                                        <br>
                                        <b>Должность:</b> {{ $title->teacher->post->name ?? '' }}
                                    </td>
                                    <td>
                                        @if ( !empty($title->add_teacher) )
                                            {{ $title->add_teacher->teacher->user->surname ?? '' }}
                                            {{ $title->add_teacher->teacher->user->name ?? '' }}
                                            {{ $title->add_teacher->teacher->user->patronymic ?? '' }}
                                            <br>
                                            <b>Академическая степень: </b> {{ $title->add_teacher->teacher->academic_degree->name ?? 'Нет' }}
                                            <br>
                                            <b>Академическое звание: </b> {{ $title->add_teacher->teacher->status->name ?? 'Нет' }}
                                            <br>
                                            <b>Должность: </b> {{ $title->add_teacher->teacher->post->name ?? '' }}
                                        @else
                                            Отсутствует
                                        @endif
                                    </td>
                                    <td>{{ $title->title->name }}</td>
                                    <td>{{ $title->title->description }}</td>
                                    <td class="text-center">{{ $title->title->software }}</td>
                                    <td class="text-center">
                                        <a href="/head/advisers/negative/edit/{{ $title->id }}" class="btn btn-success">Редактировать</a>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $titles->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5" role="alert">
                    Нет заявок.
                </div>
            @endif
        </div>
    </div>

@endsection
