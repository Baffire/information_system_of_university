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
                        <thead>
                            <tr class="border-bottom">
                                <th>#</th>
                                <th>Предложил</th>
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th>Программное обеспечение</th>
                                <th>Уровень подготовки</th>
                                <th>Образовательная программа</th>
                                <th>Дата создания</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $titles as $title )
                            <tr >
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ $title->teacher->user->name }}
                                    {{ $title->teacher->user->patronymic }}
                                    {{ $title->teacher->user->surname }}
                                </td>
                                <td>{{ $title->name }}</td>
                                <td>{{ $title->description }}</td>
                                <td class="p-1">{{ $title->software }}</td>
                                <td class="p-1">{{ $title->degree->name }}</td>
                                <td class="p-1">{{ $title->training_program->name }}</td>
                                <td class="p-1">{{ date('d.m.Y', strtotime($title->created_at)) }}</td>
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

            <div class="text-center mt-5 mb-5">
                <a href="/teacher/create_title" class="btn btn-success mr-1">Предложить тему</a>
                <a href="/teacher/create_titles" class="btn btn-success">Предложить темы</a>
            </div>
        </div>
    </div>

@endsection
