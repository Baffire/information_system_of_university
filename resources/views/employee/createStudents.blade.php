@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Форма создания новых студентов
            </p>

            @if (!empty($message))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="training_program">Образовательная программа: </label>
                            <select name="training_program" class="form-control" id="training_program">
                                <option hidden>Образовательная программа</option>
                                @foreach ( $training_programs as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="degree">Уровень подготовки: </label>
                            <select name="degree" class="form-control" id="degree">
                                <option hidden>Уровень подготовки</option>
                                @foreach ( $degrees as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="year_of_admission">Год набора: </label>
                            <select name="year_of_admission" class="form-control" id="year_of_admission">
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
                    <div class="form-group">
                        <label for="file">students.xls, students.xlsx</label>
                        <input name="file" type="file" class="form-control-file" id="file">
                        <small>В файле может быть не более тридцати наименований</small>
                    </div>
                    <div class="text-center mt-5 mb-3">
                        <input type="submit" value="Создать" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
