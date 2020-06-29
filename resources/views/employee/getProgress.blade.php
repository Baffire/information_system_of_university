@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <div class="text-center mt-3">
                <p class="h4">
                    Прогресс продготовки к ИГА студентов
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

            @if (count($students) != 0)

                @if (!empty($message))
                    <div class="alert alert-{{ $status }}" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table mt-3 bg-white text-center">
                        <thead>
                        <tr class="text-center align-middle">
                            <th class="align-middle">#</th>
                            <th class="text-left align-middle">Наименование контроля</th>
                            <th class="text-left align-middle">Проверяющий</th>
                            @foreach ( $students as $student )
                                <td class="text-center p-1 m-0">
                                    {{ $student->user->surname }}
                                    {{ $student->user->name }}
                                    {{ $student->user->patronymic }}
                                </td>
                            @endforeach
                            <th class="text-center align-middle">Действие</th>
                        </tr>
                        </thead>
                        <tbody >
                        @foreach($roadmaps as $roadmap)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $roadmap->name }}</td>
                                <td class="text-left curator">
                                    Научный руководитель: <br>
                                    Сотрудник кафедры:
                                </td>

                                @foreach ( $roadmap->degree_of_preparation as $item )
                                    <td>
                                        @if($item->confirmation == 1)
                                            <div class="text-center align-middle circle done top">
                                                &#10004;
                                            </div>
                                        @else
                                            <div class="text-center align-middle circle notDone top"></div>
                                        @endif
                                        <br>
                                        @if($item->employee_confirm == 1)
                                            <div class="text-center align-middle circle done">
                                                &#10004;
                                            </div>
                                        @else
                                            <div class="text-center align-middle circle notDone"></div>
                                        @endif
                                    </td>
                                @endforeach

                                <td>
                                    <a href="/employee/progress/get/edit/{{ $roadmap->id }}" class="btn btn-secondary">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <a href="download" class="btn btn-secondary mt-5 mb-5">Получить список в формате .xls</a>
                </div>
            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет дорожной карты.
                </div>
            @endif
        </div>
    </div>

@endsection
