@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Форма создания тем ВКР
            </p>

            @if (!empty($message))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <form action="" method="POST" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">titles.xls, titles.xlsx</label>
                    <input name="file" type="file" class="form-control-file" id="file">
                    <small>В файле может быть не более восьми наименований</small>
                </div>
                <div class="form-group">
                    <label for="training_program">Образовательная программа</label>
                    <select class="form-control" name="training_program" id="training_program">
                        <option hidden>Выберите образовательную программу</option>
                        @foreach( $training_programs as $training_program )
                            <option value="{{ $training_program->id }}">{{ $training_program->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="degree">Уровень подготовки студентов</label>
                    <select class="form-control" name="degree" id="degree">
                        <option hidden>Выберите уровень подготовки</option>
                        @foreach( $degrees as $degree )
                            <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center mt-5 mb-3">
                    <input type="submit" class="btn btn-success" value="Предложить темы">
                </div>
            </form>
        </div>
    </div>

@endsection
