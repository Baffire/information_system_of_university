@extends('student.layouts.app')

@section('content')
    <div class="col-sm-12 col-md-9 col-lg-10">


            <div class="personal p-3 mt-3 shadow">
                <p class="h5 text-center mt-3">
                    Дорожная карта подготовки к ГИА
                </p>

            @if ( count($roadmaps) != 0 )
                @if (!empty($message))
                    <div class="alert alert-secondary" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table bg-white mt-3 text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Наименование контроля</th>
                            <th>Старт</th>
                            <th>Завершение</th>
                            <th>Файл</th>
                            <th colspan="2">Статус</th>
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
                                    <td class="text-center">
                                        @if ( $roadmap->confirmation == 1)
                                            @if( !empty($roadmap->file) )
                                                <a href="/student/progress/download/{{ $roadmap->id }}" class="btn btn-success m-1">Скачать</a>
                                            @endif
                                        @else
                                            @if ( !empty($roadmap->file) )
                                                <a href="/student/progress/upload/{{ $roadmap->id }}" class="btn btn-secondary m-1">Изменить</a>
                                                <a href="/student/progress/download/{{ $roadmap->id }}" class="btn btn-success m-1">Скачать</a>
                                            @else
                                                <a href="/student/progress/upload/{{ $roadmap->id }}" class="btn btn-success">Загрузить</a>
                                            @endif
                                        @endif
                                    </td>
                                    @if ( $roadmap->confirmation == 1 )
                                        <td>
                                            <div class="alert alert-success m-0 p-2" role="alert">
                                                Научный руководитель принял работу
                                            </div>
                                        </td>
                                    @elseif ( $roadmap->negative == 1 )
                                        <td>
                                            <div class="alert alert-danger m-0 p-2" role="alert">
                                                Научный руководитель не принял работу
                                            </div>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if ( $roadmap->employee_confirm == 1 )
                                        <td>
                                            <div class="alert alert-success m-0 p-2" role="alert">
                                                Сотрудник кафедры принял работу
                                            </div>
                                        </td>
                                    @elseif ( $roadmap->employee_negative == 1 )
                                        <td>
                                            <div class="alert alert-danger m-0 p-2" role="alert">
                                                Сотрудник кафедры не принял работу
                                            </div>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-success" role="alert">
                Нет доступной дорожной карты
            </div>
        @endif

    </div>
@endsection
