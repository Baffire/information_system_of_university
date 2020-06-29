@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            @if (count($titles) != 0)
                <p class="h5 text-center mt-3">
                    Список утвержденных тем ВКР
                </p>
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <th>#</th>
                        <th>Тема выпускной квалификационной работы</th>
                        <th>Предложил</th>
                        <th>Описание</th>
                        <th>Программное обеспечение</th>
                        <th>Образовательная программа</th>
                        <th>Статус</th>
                        </thead>
                        <tbody>
                        @foreach( $titles as $title )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $title->name }}</td>
                                <td>
                                    {{ $title->teacher->user->name }}
                                    {{ $title->teacher->user->patronymic }}
                                    {{ $title->teacher->user->surname }}
                                </td>
                                <td>{{ $title->description }}</td>
                                <td>{{ $title->software }}</td>
                                <td>{{ $title->training_program->name }}</td>
                                <td class="text-center" colspan="2">
                                    <div class="alert alert-success m-0" role="alert">
                                        Утверждена {{ date('d.m.Y', strtotime($title->date_control)) }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $titles->links() }}

                </div>
            @else
                <div class="alert alert-success mt-5" role="alert">
                    Нет утвержденных тем.
                </div>
            @endif
        </div>
    </div>

@endsection
