@extends('head.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список преподавателей
            </p>

            <div class="table-responsive">
                <table class="table bg-white mt-3">
                    @if (!empty($message))
                        <div class="alert alert-{{ $status }}" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ФИО</th>
                        <th>E-mail</th>
                        <th>Ученая степень</th>
                        <th>Звание</th>
                        <th>Должность</th>
                        <th>Студенты, закрепленные за преподавателем</th>
                        <th>Статистика</th>
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

                            <td><a href="teachers/rating/{{ $teacher->id }}" class="btn btn-success">Cмотреть</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $teachers->links() }}
            </div>
        </div>
    </div>

@endsection
