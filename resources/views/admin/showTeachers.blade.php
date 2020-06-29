@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список преподавателей
            </p>

            @if(count($teachers) != 0)
                <div class="text-center mt-4 mb-2">
                    <form action="" method="POST">
                        @csrf
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="department_id" name="sort" class="custom-control-input" value="department_id">
                            <label class="custom-control-label" for="department_id">Кафедра</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="created_at" name="sort" class="custom-control-input" value="created_at">
                            <label class="custom-control-label" for="created_at">Дата добавления</label>
                        </div>
                        <div class="text-center mt-3">
                            <input type="submit" class="btn btn-secondary" value="Сортировать">
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless mt-3 bg-white">
                        <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">ФИО</th>
                                <th scope="col">Академическая степень</th>
                                <th scope="col">Звание</th>
                                <th scope="col">Должность</th>
                                <th scope="col">Email</th>
                                <th scope="col">Кафедра</th>
                                <th scope="col">Редактировать</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $teacher->user->name }}
                                    {{ $teacher->user->patronymic }}
                                    {{ $teacher->user->surname }}
                                </td>
                                <td>{{ $teacher->academic_degree->name ?? '' }}</td>
                                <td>{{ $teacher->status->name ?? '' }}</td>
                                <td>{{ $teacher->post->name }}</td>
                                <td>{{ $teacher->user->email }}</td>
                                <td>{{ $teacher->department->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="/admin/teachers/edit/{{ $teacher->id }}">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    {{ $teachers->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5" role="alert">
                    Нет пользователей.
                </div>
            @endif
        </div>
    </div>

@endsection

