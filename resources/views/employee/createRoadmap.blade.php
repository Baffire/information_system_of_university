@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-2">
                Форма загрузки дорожной карты для подготовки к ГИА
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }}" role="alert">
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

            <div class="table-responsive p-5">
                <table class="table table-borderless mt-3 bg-white">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="degree">Степень: </label>
                            <select name="degree" class="form-control" id="degree">
                                @foreach ( $degrees as $degree )
                                    <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="training_program">Направление подготовки: </label>
                            <select name="training_program" class="form-control" id="training_program">
                                @foreach ( $training_programs as $training_program )
                                    <option value="{{ $training_program->id }}">{{ $training_program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <label for="file">roadmap.xls, roadmap.xlsx</label>
                            <input name="file" type="file" class="form-control-file" id="file">
                            <small>В файле может быть не более тридцати наименований</small>
                        </div>
                        <div class="text-center mt-5">
                            <input type="submit" class="btn btn-success" value="Добавить">
                        </div>
                    </form>
                </table>
            </div>
        </div>
    </div>

@endsection
