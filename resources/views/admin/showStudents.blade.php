@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список студентов
            </p>

            @if(count($students) != 0)
                <div class="text-center mt-4 mb-2">
                    <form action="" method="POST">
                        @csrf
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="department_id" name="sort" class="custom-control-input" value="department_id">
                            <label class="custom-control-label" for="department_id">Факультет</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="faculty_id" name="sort" class="custom-control-input" value="faculty_id">
                            <label class="custom-control-label" for="faculty_id">Кафедра</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="training_program_id" name="sort" class="custom-control-input" value="training_program_id">
                            <label class="custom-control-label" for="training_program_id">Образовательная программа</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="degree_id" name="sort" class="custom-control-input" value="degree_id">
                            <label class="custom-control-label" for="degree_id">Степень</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="year_of_admission" name="sort" class="custom-control-input" value="year_of_admission">
                            <label class="custom-control-label" for="year_of_admission">Год набора</label>
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
                                <th>№</th>
                                <th>ФИО</th>
                                <th>Кафедра</th>
                                <th>Образовательная программа</th>
                                <th>Степень</th>
                                <th>Год поступления</th>
                                <th>Редактировать</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $student->user->name }}
                                    {{ $student->user->patronymic }}
                                    {{ $student->user->surname }}
                                </td>
                                <td>{{ $student->department->name }}</td>
                                <td>{{ $student->training_program->name }}</td>
                                <td>{{ $student->degree->name }}</td>
                                <td class="text-center">{{ $student->year_of_admission }}</td>
                                <td>
                                    <a class="btn btn-success" href="/admin/students/edit/{{ $student->id }}">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5">
                    {{ $students->links() }}
                </div>
            @else
                <div class="alert alert-success mt-5" role="alert">
                    Нет пользователей.
                </div>
            @endif
        </div>
    </div>

@endsection

