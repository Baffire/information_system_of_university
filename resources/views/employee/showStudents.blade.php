@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список студентов
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }} ml-5 mr-5" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive pl-5 pr-5 mt-5">
                <table class="table table-borderless mt-3 bg-white">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="degree">Уровень подготовки: </label>
                            <select name="degree" class="form-control" id="degree">
                                <option hidden>Выберите уровень подготовки</option>
                                @foreach ( $degrees as $degree )
                                    <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="training_program">Образовательная программа: </label>
                            <select name="training_program" class="form-control" id="training_program">
                                <option hidden>Выберите программу</option>
                                @foreach ( $training_programs as $training_program )
                                    <option value="{{ $training_program->id }}">{{ $training_program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year_of_admission">Год набора: </label>
                            <select name="year_of_admission" class="form-control" id="year_of_admission">
                                <option hidden>Выберите год</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                        <div class="text-center mt-5">
                            <input type="submit" class="btn btn-success" value="Найти">
                        </div>
                    </form>
                </table>
            </div>

            <div class="text-center mt-5 mb-5">
                <a href="/employee/student/create" class="btn btn-success mr-5">Добавить нового студента</a>
                <a href="/employee/students/create" class="btn btn-success">Добавить новых студентов</a>
            </div>

        </div>
    </div>

@endsection
