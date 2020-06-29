@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">

            <p class="h5 text-center mt-3">
                Темы от студентов
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }}" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if (count($requests) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                            <th>#</th>
                            <th>Студент</th>
                            <th>Тема ВКР</th>
                            <th>Описание</th>
                            <th>Прораммное обеспечение</th>
                            <th>Образовательная программа</th>
                            <th class="text-center">Принять</th>
                            <th class="text-center">Отказать</th>
                        </thead>
                        <tbody>
                            @foreach( $requests as $request )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $request->student->user->surname }}
                                        {{ $request->student->user->name }}
                                        {{ $request->student->user->patronymic }}
                                    </td>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->description }}</td>
                                    <td>{{ $request->software }}</td>
                                    <td>{{ $request->student->training_program->name }}</td>

                                    @if( $request->confirmation == null && $request->negative == null)
                                        <td>
                                            <a class="btn btn-success" href="/teacher/students/titles/1/{{ $request->id }}">Принять</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-secondary" href="/teacher/students/titles/0/{{ $request->id }}">Отказать</a>
                                        </td>
                                    @elseif ( $request->negative == null )
                                        <td class="text-center" colspan="2">
                                            <div class="alert alert-success" role="alert">
                                                Принято
                                            </div>
                                        </td>
                                    @elseif ( $request->confirmation == null )
                                        <td class="text-center" colspan="2">
                                            <div class="alert alert-danger" role="alert">
                                                Отказано
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $requests->links() }}

            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет заявок на дипломное руководство.
                </div>
            @endif
        </div>
    </div>

@endsection
