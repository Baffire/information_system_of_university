@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Статистика преподавателя
            </p>
            <p class="h5 text-center mt-3">
                {{ $teacher->user->surname }} {{ $teacher->user->name }} {{ $teacher->user->patronymic }}
            </p>

            <div class="table-responsive">
                <table class="table bg-white mt-3">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Всего предложено тем</th>
                            <th class="align-middle text-center">Принято</th>
                            <th class="align-middle text-center">Отклонено</th>
                            <th class="align-middle text-center">На рассмотрении</th>
                            <th class="align-middle text-center">Количество защитившихся студентов</th>
                            <th class="align-middle text-center">С оценкой отлично</th>
                            <th class="align-middle text-center">С оценкой хорошо</th>
                            <th class="align-middle text-center">С оценкой удовлетнорительно</th>
                            <th class="align-middle text-center">С оценкой неудовлетворительно</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="align-middle text-center">{{ $title_requests_all }}</td>
                            <td class="align-middle text-center">{{ $title_requests_confirm }}</td>
                            <td class="align-middle text-center">{{ $title_requests_negative }}</td>
                            <td class="align-middle text-center">{{ $title_requests_unknown }}</td>
                            <td class="align-middle text-center">{{ $advisers_thesis_defense }}</td>
                            <td class="align-middle text-center">{{ $advisers_thesis_defense_a }}</td>
                            <td class="align-middle text-center">{{ $advisers_thesis_defense_b }}</td>
                            <td class="align-middle text-center">{{ $advisers_thesis_defense_c }}</td>
                            <td class="align-middle text-center">{{ $advisers_thesis_defense_d }}</td>
                        </tr>
                    </tbody>
                </table>

                @if (count($title_requests) != 0 )
                    <p class="h5 text-center mt-5">
                        Все предложенные темы преподавателя
                    </p>

                    <table class="table bg-white mt-3">
                        <thead>
                            <tr>
                                <th>Наименование темы</th>
                                <th>Описание</th>
                                <th>Программное обеспечение</th>
                                <th>Образовательная программа</th>
                                <th>Дата создания</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($title_requests as $title_request)
                                <tr>
                                    <td class="align-middle">{{ $title_request->name }}</td>
                                    <td class="align-middle">{{ $title_request->description }}</td>
                                    <td class="align-middle">{{ $title_request->software }}</td>
                                    <td class="align-middle">{{ $title_request->training_program->name }}</td>
                                    <td class="align-middle">{{ date('d.m.Y', strtotime($title_request->created_at)) }}</td>
                                    <td class="align-middle">
                                        @if ($title_request->control)
                                            <div class="alert alert-success text-center">
                                                Принята {{ date('d.m.Y', strtotime($title_request->date_control)) }}
                                            </div>
                                        @elseif ($title_request->negative)
                                            <div class="alert alert-danger text-center">
                                                Отклонена {{ date('d.m.Y', strtotime($title_request->updated_at)) }}
                                            </div>
                                        @else
                                            <div class="alert alert-warning text-center">
                                                На рассмотрении {{ date('d.m.Y', strtotime($title_request->updated_at)) }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center mb-4 mt-5">
                        {{ $title_requests->links() }}
                    </div>

                @endif
            </div>
        </div>
    </div>

@endsection
