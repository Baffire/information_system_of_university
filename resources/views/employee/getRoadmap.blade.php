@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <div class="text-center mt-3">
                <p class="h4">
                    Дорожная карта для подготовки к ГИА
                </p>
                <p class="h5">
                    по направлению "{{ $training_program }}"
                </p>
                <p class="h5">
                    год набора {{ $year }}
                </p>
                <div class="h5">
                <span>
                    ( {{ $degree }} )
                </span>
                </div>
            </div>

            @if (!empty($message))
                <div class="alert alert-{{ $status }}" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table mt-3 bg-white">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th class="text-left">Вид контроля</th>
                            <th style="min-width: 150px">Дата начала</th>
                            <th style="min-width: 150px">Дата окончания</th>
                            <th style="min-width: 150px">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $roadmaps as $item )
                            <tr class="text-center">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="text-left p-2">{{ $item->name }}</td>

                                <td class="p-2">
                                    @if(!empty($item->start_date))
                                        {{ date('d.m.Y', strtotime($item->start_date)) }}
                                    @endif
                                </td>
                                <td class="p-2">
                                    @if(!empty($item->finish_date))
                                        {{ date('d.m.Y', strtotime($item->finish_date)) }}
                                        @if ( date('H:i', strtotime($item->finish_date)) != "00:00" )
                                            <br><b>Время : </b>
                                            {{ date('H:i', strtotime($item->finish_date)) }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="/employee/roadmap/get/edit/{{ $item->id }}" class="btn btn-success">Редактировать</a>
                                    <a href="/employee/roadmap/get/delete/{{ $item->id }}" class="btn btn-secondary mt-2 mb-0">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center mt-5 mb-4">
                    <a href="/employee/roadmap/get/create" class="btn btn-success">Добавить пункт контроля</a>
                </div>
            </div>
        </div>

    </div>

@endsection
