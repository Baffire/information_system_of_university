@extends('teacher.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-8 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="h5 text-center mt-3">
                Форма редактирования темы ВКР
            </p>

            <form action="" method="POST" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="name">Наименование</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ $title['name'] }}">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control" id="description" rows="3">{{ $title['description'] }}</textarea>
                    <small id="descriptionHelp" class="form-text text-muted">Приведите краткое описание предметной области.</small>
                </div>
                <div class="form-group">
                    <label for="software">Программное обеспечение</label>
                    <textarea name="software" class="form-control" id="software" rows="3">{{ $title['software'] }}</textarea>
                    <small id="softwareHelp" class="form-text text-muted">Перечислите программы, которые должен знать студент при проведении исследования по данной теме.</small>
                </div>
                <div class="form-group">
                    <label for="training_program">Образовательная программа</label>
                    <select class="form-control" name="training_program" id="training_program">
                        <option value="{{ $training_program->id }}" selected hidden>{{ $training_program->name }}</option>
                        @foreach( $training_programs as $training_program )
                            <option value="{{ $training_program->id }}">{{ $training_program->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="degree">Уровень подготовки студентов</label>
                    <select class="form-control" name="degree" id="degree">
                        <option value="{{ $degree->id }}" selected hidden>{{ $degree->name }}</option>
                        @foreach( $degrees as $degree )
                            <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center mt-5 mb-3">
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
            </form>
        </div>
    </div>

@endsection
