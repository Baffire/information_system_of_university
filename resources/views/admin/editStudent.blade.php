@extends('admin.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3 mb-5">
                Форма редактирования пользователя
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label">Имя: </label>
                    <div class="col-md-9">
                        <input name="name" id="name" type="text" class="form-control" value="{{ $student->user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="patronymic" class="col-md-3 col-form-label">Отчество: </label>
                    <div class="col-md-9">
                        <input name="patronymic" id="patronymic" type="text" value="{{ $student->user->patronymic }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-md-3 col-form-label">Фамилия: </label>
                    <div class="col-md-9">
                        <input name="surname" id="surname" type="text" class="form-control" value="{{ $student->user->surname }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role_id" class="col-md-3 col-form-label">Кафедра: </label>
                    <div class="col-md-9">
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="{{ $student->department_id }}" selected hidden>{{ $student->department->name }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role_id" class="col-md-3 col-form-label">Направление подготовки: </label>
                    <div class="col-md-9">
                        <select name="training_program_id" id="training_program_id" class="form-control">
                            <option value="{{ $student->training_program_id }}" selected hidden>{{ $student->training_program->name }}</option>
                            @foreach($training_programs as $training_program)
                                <option value="{{ $training_program->id }}">{{ $training_program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role_id" class="col-md-3 col-form-label">Степень: </label>
                    <div class="col-md-9">
                        <select name="degree_id" id="degree_id" class="form-control">
                            <option value="{{ $student->degree_id }}" selected hidden>{{ $student->degree->name }}</option>
                            @foreach($degrees as $degree)
                                <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="year_of_admission" class="col-md-3 col-form-label">Год поступления: </label>
                    <div class="col-md-9">
                        <select name="year_of_admission" class="form-control" id="year_of_admission">
                            <option value="{{ $student->year_of_admission }}" selected hidden>{{ $student->year_of_admission }}</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-5 mb-5">
                    <input type="submit" class="btn btn-success">
                </div>

            </form>

        </div>
    </div>
@endsection
