@extends('student.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 shadow">
            <p class="h5 text-center mt-3">
                Список тем ВКР
            </p>

            @if(count($titles) != 0)
                @if (!empty($message))
                    <div class="alert alert-{{ $status }}" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table bg-white mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Преподаватель</th>
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th>Программное обеспечение</th>
                                <th class="text-center">Принято</th>
                                <th class="text-center">Отклонено</th>
                                <th class="text-center">Редактировать</th>
                                <th class="text-center">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($titles as $title)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $title->teacher->user->name }}
                                    {{ $title->teacher->user->patronymic }}
                                    {{ $title->teacher->user->surname }}
                                </td>
                                <td>{{ $title->name }}</td>
                                <td> {{ $title->description }}</td>
                                <td> {{ $title->software }}</td>

                                @if ( !empty($title->confirmation) || !empty($title->negative) )
                                    <td class="text-center">
                                        @if ( $title->confirmation == 1 )
                                            &#10004;
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ( $title->negative == 1 )
                                            &#10004;
                                        @endif
                                    </td>
                                @else
                                    <td class="text-center" colspan="2">
                                        <div class="alert alert-warning mt-5 mb-5" role="alert">
                                            Вы подали заявку {{ date('d.m.Y', strtotime($title->created_at)) }}. Ожидайте результатов
                                        </div>
                                    </td>
                                @endif
                                <td class="text-center">
                                    <a href="/student/teachers/edit_title/{{ $title->id }}" class="btn btn-success">Редактировать</a>
                                </td>
                                <td class="text-center">
                                    <a href="/student/teachers/delete_title/{{ $title->id }}" class="btn btn-secondary">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $titles->links() }}
                </div>

            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет заявок.
                </div>
            @endif
        </div>
    </div>
@endsection
