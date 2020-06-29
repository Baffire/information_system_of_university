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
                                <th class="text-center">Статус</th>
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
                                <td> {{ $title->title->name }} </td>
                                <td style="min-width: 250px"> {{ $title->title->description }} </td>
                                <td> {{ $title->title->software }} </td>
                                <td class="text-center">
                                    @if ( !empty($title->title->title_confirm) )
                                        @if ( !empty($title->title->title_confirm->confirmation))
                                            <div class="alert alert-success p-2 text-center" role="alert">
                                                Закреплена {{ date('d.m.Y', strtotime($title->title->title_confirm->date_control)) }}
                                            </div>
                                            @break
                                        @elseif ( !empty($title->title->title_confirm->negative))
                                            <div class="alert alert-danger p-2 text-center" role="alert">
                                               Отклонена заведующим кафедрой {{ date('d.m.Y', strtotime($title->title->title_confirm->updated_at)) }}
                                            </div>
                                        @else
                                            @if ( !empty($title->confirmation))
                                                <div class="alert alert-success p-2 text-center" role="alert">
                                                    Принята {{ date('d.m.Y', strtotime($title->updated_at)) }}
                                                </div>
                                            @elseif ( !empty($title->negative))
                                                <div class="alert alert-danger p-2 text-center" role="alert">
                                                    Отклонена {{ date('d.m.Y', strtotime($title->updated_at)) }}
                                                </div>
                                            @elseif ( !empty($title->ignored))
                                                <div class="alert alert-secondary p-2 text-center" role="alert">
                                                    Удалена {{ date('d.m.Y', strtotime($title->updated_at)) }}<br>
                                                    в виду истечения срока<br>
                                                    (2 дня)
                                                </div>
                                            @else
                                                <div class="alert alert-warning p-2 text-center" role="alert">
                                                    Заявка подана {{ date('d.m.Y', strtotime($title->updated_at)) }}. <br>
                                                    Ожидайте результатов
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        @if ( !empty($title->confirmation))
                                            <div class="alert alert-success p-2 text-center" role="alert">
                                                Принята {{ date('d.m.Y', strtotime($title->updated_at)) }}
                                            </div>
                                        @elseif ( !empty($title->negative))
                                            <div class="alert alert-danger p-2 text-center" role="alert">
                                                Отклонена {{ date('d.m.Y', strtotime($title->updated_at)) }}
                                            </div>
                                        @elseif ( !empty($title->ignored))
                                            <div class="alert alert-secondary p-2 text-center" role="alert">
                                                Удалена {{ date('d.m.Y', strtotime($title->updated_at)) }}<br>
                                                в виду истечения срока<br>
                                                (2 дня)
                                            </div>
                                        @else
                                            <div class="alert alert-warning p-2 text-center" role="alert">
                                                Заявка подана {{ date('d.m.Y', strtotime($title->updated_at)) }}. <br>
                                                Ожидайте результатов
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="/student/titles/requests/delete/{{ $title->id }}" class="btn btn-secondary">Удалить</a>
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
