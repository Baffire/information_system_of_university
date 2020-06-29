@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список преподавателей
            </p>

            @if(count($teachers) != 0)
                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>E-mail</th>
                            <th>Ученая степень</th>
                            <th>Звание</th>
                            <th>Должность</th>
                            <th>Студенты, закрепленные за преподавателем</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $teacher->user->surname }} {{ $teacher->user->name }} {{ $teacher->user->patronymic }}</td>
                                <td class="align-middle">{{ $teacher->user->email }}</td>
                                <td class="align-middle">{{ $teacher->academic_degree->name }}</td>

                                <td class="align-middle">{{ $teacher->status->name ?? 'Нет звания' }}</td>
                                <td class="align-middle">{{ $teacher->post->name }}</td>

                                <td class="align-middle">
                                    <ol>
                                        @foreach( $teacher->title_confirm as $student)
                                            @if( $student->confirmation == 1 )
                                                <li>
                                                    {{ $student->student->user->surname }}
                                                    {{ $student->student->user->name }}
                                                    {{ $student->student->user->patronymic }}
                                                    <br>
                                                    {{ $student->student->training_program->name }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $teachers->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5 mb-5" role="alert">
                    Нет пользователей.
                </div>
            @endif

            <div class="text-center mb-3">
                <a href="/employee/teacher/create" class="btn btn-success mr-5">Добавить преподавателя</a>
                <a href="/employee/teachers/create" class="btn btn-success">Добавить преподавателей</a>
            </div>
        </div>

    </div>

@endsection
