@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список тем ВКР
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }}" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if (count($titles) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                            <th>#</th>
                            <th >Наименование</th>
                            <th>Описание</th>
                            <th>Программное обеспечение</th>
                            <th>Образовательная программа</th>
                            <th>Уровень подготовки</th>
                            <th>Дата создания</th>
                            <th class="text-center">Статус</th>
                            <th>Комментарий</th>
                            <th class="text-center w-1">Действие</th>
                        </thead>
                        <tbody>
                            @foreach( $titles as $title )
                                <tr>
                                    <td class="p-1">{{ $loop->iteration }}</td>
                                    <td class="p-1">{{ $title->name }}</td>
                                    <td class="p-1">{{ $title->description }}</td>
                                    <td class="p-1">{{ $title->software }}</td>
                                    <td class="p-1">{{ $title->training_program->name }}</td>
                                    <td class="p-1">{{ $title->degree->name }}</td>
                                    <td class="p-1">{{ date('d.m.Y', strtotime($title->created_at)) }}</td>
                                    @if ($title->control == 1)
                                        <td colspan="3">
                                            <div class="alert alert-success text-center m-0 p-2" role="alert">
                                                Принята <br>
                                                {{ date('d.m.Y', strtotime($title->date_control)) }}
                                            </div>
                                        </td>
                                    @elseif ($title->negative == 1)
                                        <td>
                                            <div class="alert alert-danger text-center m-0 p-3" role="alert">
                                                Отклонена
                                            </div>
                                        </td>
                                        <td class="p-1">{{ $title->comment }}</td>
                                        <td>
                                            <div class="text-center">
                                                <a href="/teacher/my_titles/delete/{{ $title->id }}" class="btn btn-secondary">Удалить</a>
                                            </div>
                                        </td>
                                    @elseif ($title->control == null && $title->negative == null)
                                        <td>
                                            <div class="alert alert-warning text-center m-0 p-2" role="alert">
                                                Тема на рассмотрении
                                            </div>
                                        </td>
                                        <td class="text-center" colspan="2">
                                            <div class="m-auto">
                                                <a href="/teacher/my_titles/edit/{{ $title->id }}" class="btn btn-success">Редактировать</a>
                                            </div>
                                            <div class="m-auto p-2">
                                                <a href="/teacher/my_titles/delete/{{ $title->id }}" class="btn btn-secondary w-20">Удалить</a>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $titles->links() }}
                </div>

            @else
                <div class="alert alert-success mt-5 mb-3" role="alert">
                    Вы еще не предложили ни одной темы.
                </div>
            @endif

            <div class="text-center mt-5 mb-5">
                <a href="/teacher/create_title" class="btn btn-success mr-1">Предложить тему</a>
                <a href="/teacher/create_titles" class="btn btn-success">Предложить темы</a>
            </div>
        </div>
    </div>

@endsection
