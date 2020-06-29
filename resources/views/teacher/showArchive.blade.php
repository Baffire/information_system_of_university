@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список тем ВКР
            </p>

            @if (count($titles) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead class="border-bottom">
                        <th>#</th>
                        <th class="p-1">Руководитель</th>
                        <th class="p-1">Дополнительный руководитель</th>
                        <th class="p-1">Тема выпускной квалификационной работы</th>
                        <th class="p-1">Дата утверждения</th>
                        <th class="p-1">Приказ о закрпелении</th>
                        <th class="p-1">Приказ о пере- закрпелении</th>
                        <th class="p-1 text-center">Оценка на защите</th>
                        <th class="p-1 text-center">Дата защиты</th>
                        <th class="p-1 text-center">Приказ о защите</th>
                        </thead>
                        <tbody>
                        @foreach( $titles as $title )
                            <tr>
                            <tr class="table-success">
                                <td colspan="12">
                                    <b>Студент: </b>
                                    {{ $title->student->user->surname }}
                                    {{ $title->student->user->name }}
                                    {{ $title->student->user->patronymic }}
                                    <b>Образовательная программа: </b>
                                    {{ $title->student->training_program->name }}
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2" class="p-0 text-center">{{ $loop->iteration }}</td>
                            </tr>
                            <tr>
                                <td class="p-1">
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
                                <td class="p-1">
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
                                <td class="p-1">{{ $title->title->name }}</td>
                                <td class="p-1 text-center">{{ date('d.m.Y', strtotime( $title->date_control )) }}</td>
                                <td class="p-1 text-center">{{ $title->order }}</td>
                                <td class="p-1 text-center">{{ $title->reorder }}</td>
                                <td class="p-1 text-center">{{ $title->estimate }}</td>
                                <td class="p-1 text-center">{{ date('d.m.Y', strtotime( $title->date_thesis_defense ))  }}</td>
                                <td class="p-1 text-center">{{ $title->order_thesis_defense }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $titles->links() }}
                </div>

            @else
                <div class="alert alert-success mt-5 mb-3" role="alert">
                    Нет тем для выпускных квалификационных работ.
                </div>
            @endif
        </div>
    </div>

@endsection
