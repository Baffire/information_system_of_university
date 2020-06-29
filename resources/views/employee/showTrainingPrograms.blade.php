@extends('employee.layouts.app')

@section('content')

    <div class="col-sm-12 col-md-9 col-lg-10">
        <div class="personal p-3 mt-3 border shadow">
            <p class="h5 text-center mt-3">
                Список образовательных программ
            </p>

            @if (!empty($message))
                <div class="alert alert-{{ $status }} ml-5 mr-5" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive pl-5 pr-5 mt-5">
                <table class="table table-borderless mt-3 bg-white  ">
                    @foreach( $training_programs as $training_program)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $training_program->name }}</td>
                            <td>
                                <a href="/employee/training_programs/edit/{{ $training_program->id }}" class="btn btn-success">Редактировать</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                <a href="/employee/training_programs/create" class="btn btn-success">Добавить программу</a>
            </div>
        </div>
    </div>

@endsection
