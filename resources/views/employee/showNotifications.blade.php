@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список оповещений
            </p>

            @if(count($notifications) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Сообщение</th>
                            <th>Дата начала публикации</th>
                            <th>Дата окончания публикации</th>
                            <th style="max-width: 80px">Будет видно студентам</th>
                            <th>Образовательная программа</th>
                            <th style="max-width: 120px">Будет видно преподавателям</th>
                            <th>Дата создания</th>
                            <th>Редактировать</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $notifications as $notification )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $notification->text }}</td>
                                <td> {{ date('d.m.Y', strtotime($notification->start_date)) }}</td>
                                <td> {{ date('d.m.Y', strtotime($notification->finish_date)) }}</td>
                                <td class="text-center">
                                    @if ( !empty($notification->students) )
                                        &#10004;
                                    @endif
                                </td>
                                <td>{{ $notification->training_program->name ?? '' }}</td>
                                <td class="text-center">
                                    @if ( !empty($notification->teachers) )
                                        &#10004;
                                    @endif
                                </td>
                                <td>{{ $notification->created_at->format('d.m.Y') }}</td>
                                <td>
                                    @if (Auth::id() == $notification->user_id)
                                        <div class="text-center">
                                            <a href="notifications/edit/{{ $notification->id }}" class="btn btn-success ">Редактировать</a>
                                            <a href="notifications/delete/{{ $notification->id }}" class="btn btn-secondary mt-2">Удалить</a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    Нет оповещений
                </div>
            @endif

            <div class="text-center mb-3">
                <a href="/employee/notification/create" class="btn btn-success mt-3">Создать оповещение</a>
            </div>
        </div>
    </div>

@endsection
