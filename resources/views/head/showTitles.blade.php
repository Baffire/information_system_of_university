@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Запросы на подтверждение темы ВКР
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }} ml-5 mr-5" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if (count($titles) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <th>#</th>
                        <th>Тема выпускной квалификационной работы</th>
                        <th>Предложил</th>
                        <th>Описание</th>
                        <th>Программное обеспечение</th>
                        <th>Образовательная программа</th>
                        <th>Дата создания</th>
                        <th>Проверить</th>
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
                                <td>{{ date('d.m.Y', strtotime($title->created_at)) }}</td>

                                @if( $title->control == null && $title->negative == null)
                                    <td>
                                        <a href="/head/titles/1/{{ $title->id }}" class="btn btn-success">Утвердить</a>
                                        <a href="/head/titles/0/{{ $title->id }}" class="btn btn-secondary mt-3">Отклонить</a>
                                    </td>
                                @elseif ( $title->negative == null )
                                    <td class="text-center" colspan="2">
                                        <div class="alert alert-success" role="alert">
                                            Утверждена
                                        </div>
                                    </td>
                                @elseif ( $title->control == null )
                                    <td class="text-center" colspan="2">
                                        <div class="alert alert-danger" role="alert">
                                            Отклонена
                                        </div>
                                    </td>
                                @endif

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
