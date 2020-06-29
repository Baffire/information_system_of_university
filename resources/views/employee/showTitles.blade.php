@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список тем ВКР
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }} ml-5 mr-5" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive pl-5 pr-5 mt-5">
                <table class="table table-borderless mt-3 bg-white  ">
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
                        <div class="text-center mt-5">
                            <input type="submit" class="btn btn-success" value="Найти">
                        </div>
                    </form>
                </table>
            </div>
        </div>
    </div>

@endsection
