@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Форма создания оповещения
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
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="text">Текст сообщения: </label>
                        <textarea name="text" class="form-control" id="text" rows="3">{{ $notification->text }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="start_date">Дата публикации: </label>
                            <input name="start_date" type="date" class="form-control" id="start_date" value="{{ $notification->start_date }}">
                        </div>
                        <div class="col">
                            <label for="finish_date">Дата окончания публикации: </label>
                            <input name="finish_date" type="date" class="form-control" id="finish_date" value="{{ $notification->finish_date }}">
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="form-check">
                            <input name="teachers" class="form-check-input" type="checkbox" id="teachers" value="1" @if ($notification->teachers == 1) checked @endif>
                            <label class="form-check-label" for="teachers">
                                Видно преподавателям
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="students" class="form-check-input" type="checkbox" id="students" value="1" @if ($notification->students == 1) checked @endif>
                            <label class="form-check-label" for="students">
                                Видно студентам
                            </label>
                        </div>
                        @if ($notification->students == 1)
                            <div class="form-group mt-4">
                                <label for="training_programs">Выберите направление подготовки: </label>
                                <select name="training_programs" class="form-control" id="training_programs">
                                    <option value="{{ $notification->training_program_id }}" selected>{{ $notification->training_program->name }}</option>
                                    @foreach( $training_programs as $training_program )
                                        <option value="{{ $training_program->id }}">{{ $training_program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                    <div class="text-center mt-5 mb-3">
                        <input type="submit" value="Сохранить" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
