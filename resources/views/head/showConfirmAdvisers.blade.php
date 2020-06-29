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
                <div class="text-center mt-4 mb-2">
                    <form action="" method="POST">
                        @csrf
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="updated_at" name="sort" class="custom-control-input" value="created_at">
                            <label class="custom-control-label" for="updated_at">Дата добавления</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="order" name="sort" class="custom-control-input" value="order">
                            <label class="custom-control-label" for="order">Приказ о закреплении</label>
                        </div>
                        <div class="text-center mt-3">
                            <input type="submit" class="btn btn-secondary" value="Сортировать">
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead class="border-bottom">
                            <th>#</th>
                            <th class="p-1">Руководитель</th>
                            <th class="p-1">Дополнительный руководитель</th>
                            <th class="p-1">Тема выпускной квалификационной работы</th>
                            <th class="p-1">Описание</th>
                            <th class="p-1">Программное обеспечение</th>
                            <th class="p-1">Дата утверждения</th>
                            <th class="p-1">Приказ о закрпелении</th>
                            <th class="p-1">Приказ о пере- закрпелении</th>
                            <th class="p-1">Дата защиты</th>
                            <th class="p-1 text-center">Действие</th>
                        </thead>
                        <tbody>
                        @foreach( $titles as $title )
                            <tr>
                                <tr class="table-success">
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
                                    <td class="p-1" style="min-width: 250px;">{{ $title->title->description }}</td>
                                    <td class="p-1 text-center">{{ $title->title->software }}</td>
                                    <td class="p-1 text-center">{{ date('d.m.Y', strtotime($title->date_control)) }}</td>
                                    <td class="p-1 text-center">{{ $title->order }}</td>
                                    <td class="p-1 text-center">{{ $title->reorder }}</td>
                                    <td class="p-1 text-center">
                                        @if(!empty($title->date_thesis_defense))
                                            {{ date('d.m.Y', strtotime($title->date_thesis_defense)) }}
                                        @endif
                                    </td>
                                    <td class="p-1 text-center">
                                        <a href="/head/advisers/confirm/edit/{{ $title->id }}" class="btn btn-success">Редактировать</a>
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
