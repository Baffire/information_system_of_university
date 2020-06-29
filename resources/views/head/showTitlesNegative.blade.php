@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            @if (count($titles) != 0)
                <p class="h5 text-center mt-3">
                    Список отклоненных тем ВКР
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
                        <th class="text-center">Статус</th>
                        <th>Замечания</th>
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
                                <td class="text-center">
                                    <div class="alert alert-danger m-0" role="alert">
                                        Отклонена {{ date('d.m.Y', strtotime($title->updated_at)) }}
                                    </div>
                                </td>
                                <td>{{ $title->comment }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $titles->links() }}

                </div>
            @else
                <div class="alert alert-success mt-5" role="alert">
                    Нет тем для утверждения.
                </div>
            @endif
        </div>
    </div>

@endsection
