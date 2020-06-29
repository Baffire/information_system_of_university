@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Дорожная карта подготовки к ГИА
            </p>

            @if ( !empty($roadmaps) )

                @if (!empty($message))
                    <div class="alert alert-secondary" role="alert">
                        {{ $message }}
                    </div>
                @endif

                    <div class="table-responsive">
                        <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Наименование контроля</th>
                            <th>Старт</th>
                            <th>Завершение</th>
                            <th>Файл</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roadmaps as $roadmap)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $roadmap->roadmap->name }}</td>
                                <td class="p-2">
                                    @if(!empty($roadmap->roadmap->start_date))
                                        {{ date('d.m.Y', strtotime($roadmap->roadmap->start_date)) }}
                                    @endif
                                </td>
                                <td class="p-2">
                                    @if(!empty($roadmap->roadmap->finish_date))
                                        {{ date('d.m.Y', strtotime($roadmap->roadmap->finish_date)) }}
                                        @if ( date('H:i', strtotime($roadmap->roadmap->finish_date)) != "00:00" )
                                            <br><b>Время : </b>
                                            {{ date('H:i', strtotime($roadmap->roadmap->finish_date)) }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ( !empty($roadmap->file) )
                                        <a href="/teacher/my_students/progress/download/{{ $roadmap->file->id }}/{{ $roadmap->student_id }}" class="btn btn-secondary">Скачать</a>
                                    @endif
                                </td>
                                <td>
                                    @if ( $roadmap->confirmation == 1 )
                                        <div class="alert alert-success m-0" role="alert">
                                            Сдано
                                        </div>
                                    @elseif ( $roadmap->negative == 1 )
                                        <div class="alert alert-danger m-0" role="alert">
                                            Не сдано
                                        </div>
                                    @else
                                        <a href="/teacher/my_students/progress/control/1/{{ $roadmap->id }}/{{ $roadmap->student_id }}" class="btn btn-success">Принять</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    Нет доступной дорожной карты
                </div>
            @endif
        </div>
    </div>

@endsection
