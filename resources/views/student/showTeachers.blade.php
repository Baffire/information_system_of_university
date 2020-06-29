@extends('student.layouts.app')

@section('content')
    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 shadow">
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
                        <th>Преподаватель</th>
                        <th>Ученая степень</th>
                        <th>Звание</th>
                        <th>Должность</th>
                        <th class="text-center">Подать заявку</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teacher->user->name }} {{ $teacher->user->patronymic }} {{ $teacher->user->surname }}</td>
                            <td>{{ $teacher->academic_degree->name }}</td>

                            <td>{{ $teacher->status->name ?? 'Нет звания' }}</td>
                            <td>{{ $teacher->post->name }}</td>

                            <td class="text-center">
                                <a href="/student/teachers/create_title/{{ $teacher->id }}" class="btn btn-success">Предложить тему</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection
