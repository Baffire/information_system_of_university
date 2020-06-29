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
                        <label for="training_program">Наименование образовательной программы: </label>
                        <input name="training_program" class="form-control" id="training_program" placeholder="Введите наименование программы">
                    </div>
                    <div class="text-center mt-5 mb-3">
                        <input type="submit" value="Создать" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
