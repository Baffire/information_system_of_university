@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <div class="text-center mt-3">
                <p class="h4">
                    Список тем ВК для студентов,
                </p>
                <p class="h5">
                    обучающихся по образовательной программе "{{ $training_program }}"
                </p>
                <div class="h5">
                <span>
                    ( {{ $degree }} )
                </span>
                </div>
            </div>

            @if(count($titles) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Наименование</th>
                            <th>Описание</th>
                            <th>Программное обеспечение</th>
                            <th>Предложил</th>
                            <th>Дата создания</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $titles as $title )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $title->name }}</td>
                                <td>{{ $title->description }}</td>
                                <td>{{ $title->software }}</td>
                                <td>
                                    {{ $title->teacher->user->name }}
                                    {{ $title->teacher->user->patronymic }}
                                    {{ $title->teacher->user->surname }}
                                </td>
                                <td>{{ $title->created_at->format('d.m.Y') }}</td>
                                @if ( $title->control == 1 )
                                    <td class="text-center">
                                        <div class="alert alert-success p-2" role="alert">
                                            Утверждена &#10004; {{ date('d.m.Y', strtotime($title->date_control) ) }}
                                        </div>
                                    </td>
                                @elseif ( $title->negative == 1 )
                                    <td class="text-center">
                                        <div class="alert alert-danger p-2" role="alert">
                                            Отклонена {{ date('d.m.Y', strtotime($title->updated_at) ) }}
                                        </div>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <div class="alert alert-warning p-2" role="alert">
                                            На рассмотрении
                                        </div>
                                    </td>
                                @endif
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
                    Нет тем для выпускных квалификационных работ.
                </div>
            @endif
        </div>
    </div>

@endsection
